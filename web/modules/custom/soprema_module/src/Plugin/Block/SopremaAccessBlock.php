<?php

namespace Drupal\soprema_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SopremaAccessBlock' block.
 *
 * @Block(
 *  id = "soprema_access_block",
 *  admin_label = @Translation("Soprema Access Block"),
 * )
 */
class SopremaAccessBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $render = \Drupal::service('renderer');

    $login_form       = \Drupal::formBuilder()->getForm(\Drupal\user\Form\UserLoginForm::class);
    $reset_pass_form  = \Drupal::formBuilder()->getForm(\Drupal\user\Form\UserPasswordForm::class);

    $login_form['name']['#placeholder'] = t('Email');
    $login_form['pass']['#placeholder'] = t('Password');
    $reset_pass_form['name']['#placeholder'] = t('Username or Email');


    $plain_login_form       = $render->renderPlain($login_form);
    $plain_reset_pass_form  = $render->renderPlain($reset_pass_form);

    //$site_logo = theme_get_setting('logo.url');
    $site_logo = file_create_url('public://logo/logo-front.png');

    $build = [
      '#theme' => 'soprema_access',
      '#soprema_login_form' => $plain_login_form,
      '#soprema_reset_pass_form' => $plain_reset_pass_form,
      '#site_logo' => $site_logo,
    ];

    $build['#attached']['library'][] = 'soprema_module/soprema_module.access_front';

    return $build;
  }

}
