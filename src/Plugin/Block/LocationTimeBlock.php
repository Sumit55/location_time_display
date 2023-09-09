<?php

namespace Drupal\location_time_display\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\location_time_display\LocationTimeService;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'LocationTime' block.
 *
 * @Block(
 *  id = "location_time_block",
 *  admin_label = @Translation("Location time display block"),
 * )
 */
class LocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;
  /**
   * LocationTimeDisplay Service.
   *
   * @var \Drupal\location_time_display\LocationTimeService
   */
  protected $locationTime;

  /**
   * Constructs a object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   *   Configuration Factory.
   * @param \Drupal\location_time_display\LocationTimeService $locationTime
   *   LocationTimeDisplay Service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory, LocationTimeService $locationTime) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $configFactory;
    $this->locationTime = $locationTime;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('location_time_display.locationtime_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $country = $this->configFactory->get('location_time_display.settings')->get('country');
    $city = $this->configFactory->get('location_time_display.settings')->get('city');
    $locationtime = $this->locationTime->getLocationtimeInTimezone();

    $build = [
      '#theme' => 'location_time_display',
      '#title' => $this->t('Location Time'),
      '#country' => $country,
      '#city' => $city,
      '#locationtime' => $locationtime,
    ];
    // Custom cache context.
    $build['#cache']['contexts'][] = 'location_time';
    return $build;
  }

}
