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
 *   id = "fake_msg_rest_resource",
 *   label = @Translation("Fake msg rest resource"),
 *   uri_paths = {
 *     "canonical" = "/rest_api/v1/fake_msg"
 *   }
 * )
 */
class FakeMsgRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new FakeMsgRestResource object.
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
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity object.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException('Access denied.');
    }

    if (!isset($_GET['email']) || empty($_GET['email']) ||
      !isset($_GET['message']) || empty($_GET['message']))
    {
      throw new AccessDeniedHttpException('Invalid data.');
    }

    // Results array
    $result = NULL;

    // Mail Manager
    // Create email
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'soprema_module';
    $key = 'rest_api_send_message';
    //$to = \Drupal::config('system.site')->get('mail');
    $to = 'info@soprema.es';

    $params['from'] = $_GET['email'];
    $params['message'] = $_GET['message'];

    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = TRUE;

    $mail_send = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    // Check if email was sent
    if ($mail_send['result'] == 1) {
      $result = ['success' => t('Message sent correctly.')];
      \Drupal::logger('soprema_module')->notice('Message sent correctly to ' . $to . ' from ' . $_GET['email']);
    } else {
      $result = ['error' => t('Error sending message. Try it later.')];
      \Drupal::logger('soprema_module')->notice('Error sending message to ' . $to . ' from ' . $_GET['email']);
    }

    // Set response
    $response = new ModifiedResourceResponse($result, 200);

    return $response;
  }

}
