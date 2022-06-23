<?php

namespace Drupal\soprema_module\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Random;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * A handler to provide a field that is completely custom by the administrator.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("doc_images_views_field")
 */
class DocImagesViewsField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function usesGroupBy() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Do nothing -- to override the parent query.
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['hide_alter_empty'] = ['default' => FALSE];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {

    $entity = $values->_entity;

    // Images
    $field_document_img = [];
    $field_document_img_ids = soprema_module_multiple_targets($entity->field_document_img);
    if ($field_document_img_ids != NULL) {
      foreach ($field_document_img_ids as $fid) {
        /*
        $field_document_img[] = [
          'img_path' => soprema_module_get_file_absolute_path($fid['target_id'])
        ];
        */
        $field_document_img[] = soprema_module_get_file_absolute_path($fid['target_id']);
      }
    }


    return implode($field_document_img, ',');
  }

}
