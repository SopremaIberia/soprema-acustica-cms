<?php

namespace Drupal\soprema_module\Plugin\rest\resource;

use CommerceGuys\Addressing\Subdivision\Subdivision;
use CommerceGuys\Addressing\Zone\Zone;
use CommerceGuys\Addressing\Zone\ZoneTerritory;
use Drupal\address\Element\Address;
use Drupal\address\Event\SubdivisionsEvent;
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
 *   id = "address_rest_resource",
 *   label = @Translation("Address rest resource"),
 *   uri_paths = {
 *     "canonical" = "/rest_api/v1/get_directions"
 *   }
 * )
 */
class AddressRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new AddressRestResource object.
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

    $result = get_administrative_areas();
    $response = new ModifiedResourceResponse($result, 200);

    return $response;
  }

}

function get_administrative_areas() {
  $areas = [
    "ES" => [
      "A Coruña",
      "Álava",
      "Albacete",
      "Alicante",
      "Almería",
      "Asturias",
      "Ávila",
      "Badajoz",
      "Balears",
      "Barcelona",
      "Burgos",
      "Cantabria",
      "Castellón",
      "Ceuta",
      "Ciudad Real",
      "Cuenca",
      "Cáceres",
      "Cádiz",
      "Córdoba",
      "Girona",
      "Granada",
      "Guadalajara",
      "Guipúzcoa",
      "Huelva",
      "Huesca",
      "Jaén",
      "La Rioja",
      "Las Palmas",
      "León",
      "Lleida",
      "Lugo",
      "Madrid",
      "Melilla",
      "Murcia",
      "Málaga",
      "Navarra",
      "Ourense",
      "Palencia",
      "Pontevedra",
      "Salamanca",
      "Santa Cruz de Tenerife",
      "Segovia",
      "Sevilla",
      "Soria",
      "Tarragona",
      "Teruel",
      "Toledo",
      "Valencia",
      "Valladolid",
      "Vizcaya",
      "Zamora",
      "Zaragoza",
    ],
    "PT" => [],
  ];

  return $areas;
}
