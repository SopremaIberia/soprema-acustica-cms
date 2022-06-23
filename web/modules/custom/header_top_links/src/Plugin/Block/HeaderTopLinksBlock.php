<?php

namespace Drupal\header_top_links\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HeaderTopLinksBlock' block.
 *
 * @Block(
 *  id = "header_top_links_block",
 *  admin_label = @Translation("Header Top Links"),
 * )
 */
class HeaderTopLinksBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    if (\Drupal::currentUser()->isAuthenticated()) {
      $user_name = \Drupal::currentUser()->getAccountName();
    }
    else {
      $user_name = 'Anonymous';
    }

    $build = [
      '#theme' => 'header_top_links',
      '#user_name' => $user_name,
      '#cache' => [
        'max-age' => 0,
      ]
    ];

    return $build;
  }
}
