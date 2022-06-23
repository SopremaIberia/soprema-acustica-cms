<?php

namespace Drupal\soprema_module\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "user_password_reset",
 *   label = @Translation("User password reset"),
 *   uri_paths = {
 *     "canonical" = "/rest_api/v1/user_reset_password",
 *     "https://www.drupal.org/link-relations/create" = "/rest_api/v1/user_reset_password"
 *   }
 * )
 */
class UserPasswordReset extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new UserPasswordReset object.
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
   * Responds to POST requests.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity object.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function post($request) {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException('Access denied.');
    }

    $result = ['message' => 'Ok'];

    if (isset($request['email']) && !empty($request['email'])) {

      $langcode =  \Drupal::languageManager()->getCurrentLanguage()->getId();

      $users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(array('mail' => $request['email']));

      if (count($users)) {
        $account = reset($users);

        if ($account instanceof \Drupal\user\Entity\User) {
          // Mail one time login URL and instructions using current language.
          $mail = _user_mail_notify('password_reset', $account, $langcode);
          //$mail = true;

          if ($mail) {
            $result = ['message' => t('Mail sent.')];
          }
          else {
            $result = ['message' => t('Error sending mail.')];
          }
        }
      }
      else {
        $result = ['message' => t('No mail found.')];
      }


      return new ModifiedResourceResponse($result, 200);
    }
    else {
      throw new BadRequestHttpException('Invalid parameters.');
    }
  }
}
