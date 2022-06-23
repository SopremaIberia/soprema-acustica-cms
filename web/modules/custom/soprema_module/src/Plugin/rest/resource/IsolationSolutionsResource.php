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
 *   id = "isolation_solutions_resource",
 *   label = @Translation("Isolation Solutions Resource"),
 *   uri_paths = {
 *     "canonical" = "/rest_api/v1/isolation_products"
 *   }
 * )
 */
class IsolationSolutionsResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new IsolationSolutionsResource object.
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

  //* Returns arrays with isolation products

  /**
   * Responds to GET requests.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object with isolation products.
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
    $result['isolation_types'] = [];
    $result['isolation_subtypes'] = [];
    $result['isolation_subtypes_types'] = [];
    $result['isolation_products'] = [];

    // Current lang id and default lang
    $current_lang = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $default_lang = \Drupal::languageManager()->getCurrentLanguage()->isDefault();

    // Set the vocabulary
    $vid = 'acoustic_solution_types';
    $lvl = 1;

    // Load the taxonomy terms by levels
    // First level
    $as_types = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid, 0, $lvl, TRUE);

    // Create arrays with types of isolation solutions
    foreach ($as_types as $type) {

      if (!$default_lang) {
        $type = \Drupal::service('entity.repository')->getTranslationFromContext($type, $current_lang);
      }

      $result['isolation_types'][] = [
        'tid' => $type->tid->value,
        'name' => $type->name->value,
        'field_ast_image' => _get_file_field_url($type->field_ast_image->target_id, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
        //'field_ast_image' => _get_file_field_url(27, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
      ];

      // Second level of taxonomy terms
      $as_subtypes = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid, $type->tid->value, $lvl, TRUE);
      foreach ($as_subtypes as $subtype) {

        if (!$default_lang) {
          $subtype = \Drupal::service('entity.repository')->getTranslationFromContext($subtype, $current_lang);
        }

        $result['isolation_subtypes'][] = [
          'tid' => $subtype->tid->value,
          'parent_id' => $type->tid->value,
          'name' => $subtype->name->value,
          'field_ast_image' => _get_file_field_url($subtype->field_ast_image->target_id, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
          //'field_ast_image' => _get_file_field_url(27, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
        ];

        // Third level of taxonomy terms
        $sub_as_subtypes = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid, $subtype->tid->value, $lvl, TRUE);
        foreach ($sub_as_subtypes as $sub_subtype) {
          if (!$default_lang) {
            $sub_subtype = \Drupal::service('entity.repository')->getTranslationFromContext($sub_subtype, $current_lang);
          }

          $result['isolation_subtypes_types'][] = [
            'tid' => $sub_subtype->tid->value,
            'parent_id' => $subtype->tid->value,
            'name' => $sub_subtype->name->value,
            'field_ast_image' => _get_file_field_url($sub_subtype->field_ast_image->target_id, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
            //'field_ast_image' => _get_file_field_url(27, 'taxonomy_term', 'acoustic_solution_types', 'field_ast_image')
          ];
        }
      }
    }

    // Load isolation solutions nodes
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'acoustic_solution')
      ->condition('langcode', $current_lang)
      ->accessCheck(FALSE);
    $nids = $query->execute();


    // Load all nodes
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);

    // Create array of nodes
    foreach ($nodes as $node) {
      // Get images
      // $img_layers = $node->field_as_img_layers->target_id ? soprema_module_get_file_absolute_path($node->field_as_img_layers->target_id) : NULL;
      // $img_cad_details = $node->field_as_cad_details->target_id ? soprema_module_get_file_absolute_path($node->field_as_cad_details->target_id) : NULL;
      // $img_better_isolation = $node->field_as_better_isolation->target_id ? soprema_module_get_file_absolute_path($node->field_as_better_isolation->target_id) : NULL;

      // Layers images
      $field_as_img_layers = [];
      $layers_target_ids = soprema_module_multiple_targets($node->field_as_img_layers);
      if ($layers_target_ids != NULL) {
        foreach ($layers_target_ids as $fid) {
          $field_as_img_layers[] = [
            'img_path' => soprema_module_get_file_absolute_path($fid['target_id'])
          ];
        }
      }

      // CAD images
      $field_as_cad_details = [];
      $cad_target_ids = soprema_module_multiple_targets($node->field_as_cad_details);
      if ($cad_target_ids != NULL) {
        foreach ($cad_target_ids as $fid) {
          $field_as_cad_details[] = [
            'img_path' => soprema_module_get_file_absolute_path($fid['target_id'])
          ];
        }
      }

      // Isolation images
      $field_as_better_isolation = [];
      $isolation_target_ids = soprema_module_multiple_targets($node->field_as_better_isolation);
      if ($isolation_target_ids != NULL) {
        foreach ($isolation_target_ids as $fid) {
          $field_as_better_isolation[] = [
            'img_path' => soprema_module_get_file_absolute_path($fid['target_id'])
          ];
        }
      }

      // Get files
      $data_sheet = $node->field_as_data_sheet->target_id ? soprema_module_get_file_absolute_path($node->field_as_data_sheet->target_id) : NULL;

      // Get node isolation_types
      $decision_tree = soprema_module_multiple_targets($node->field_as_decision_tree);

      // Get node layers table
      $layers_table = soprema_module_multiple_paragraphs($node->field_as_layers, 'layer_paragraph');

      $suffixes = [
        'db' => 'dB',
        'dba' => 'dBA',
        'ra' => 'ΔLw'
      ];

      // Set node values
      $result['isolation_products'][] = [
        'nid' => $node->nid->value,
        'created' => $node->created->value,
        'title' => $node->title->value,
        'field_as_code' => $node->field_as_code->value,
        'field_as_impact_noise_isolation' => $node->field_as_impact_noise_isolation->value,
        'field_as_impact_noise_suffix' => empty($node->field_as_impact_noise_suffix->value) ? '' : $suffixes[$node->field_as_impact_noise_suffix->value],
        'field_as_air_noise_isolation' => $node->field_as_air_noise_isolation->value,
        'field_as_air_noise_suffix' => empty($node->field_as_air_noise_suffix->value) ? '' : $suffixes[$node->field_as_air_noise_suffix->value],
        'field_as_thickness' => $node->field_as_thickness->value,
        'body' => $node->body->value,
        'field_as_advantages' => $node->field_as_advantages->value,
        'field_as_img_layers' => $field_as_img_layers,
        'field_as_cad_details' => $field_as_cad_details,
        'field_as_better_isolation' => $field_as_better_isolation,
        'field_as_data_sheet' => $data_sheet,
        'field_as_decision_tree' => $decision_tree,
        'field_as_layers' => $layers_table,
      ];
    }

    /*
    $result['lang'] = $current_lang;
    $result['def'] = $default_lang;
    */

    // Set response
    $response = new ResourceResponse($result, 200);
    $response->addCacheableDependency($result);

    return $response;
  }
}