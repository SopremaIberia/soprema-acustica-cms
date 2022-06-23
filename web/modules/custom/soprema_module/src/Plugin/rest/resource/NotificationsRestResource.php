<?php

namespace Drupal\soprema_module\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "notifications_rest_resource",
 *   label = @Translation("Notifications Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/rest_api/v1/notifications"
 *   }
 * )
 */
class NotificationsRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new NotificationsRestResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('soprema_module'),
      $container->get('current_user')
    );
  }

  /**
   * Responds to GET requests.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object with notifications data.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function get() {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    // Results array
    $result = [];

    // Load notifications nodes
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'notification')
      ->sort('nid', 'DESC')
      ->accessCheck(FALSE);

    if (isset($_GET['last']) && !empty($_GET['last'])) {
      $query->condition('created', $_GET['last'], '>');
    }

    $nids = $query->execute();

    // Load all nodes
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);

    // Create array of nodes
    foreach ($nodes as $node) {
      // Images
      $img_target_ids = soprema_module_multiple_targets($node->field_notification_images);
      $field_notification_images = [];
      if ($img_target_ids != NULL) {
        foreach ($img_target_ids as $fid) {
          $field_notification_images[] = [
            'img_path' => soprema_module_get_file_absolute_path($fid['target_id'])
          ];
        }
      }

      // Set node values
      $result[] = [
        'nid' => $node->nid->value,
        'created' => $node->created->value,
        'title' => $node->title->value,
        'body' => $node->body->value,
        'field_notification_links' => soprema_module_multiple_links_data($node->field_notification_links),
        'field_notification_documents' => soprema_module_multiple_files_data($node->field_notification_documents),
        'field_notification_images' => $field_notification_images,
      ];
    }

    // Set response
    $response = new ResourceResponse($result, 200);
    $response->addCacheableDependency($result);

    return $response;
  }

}
