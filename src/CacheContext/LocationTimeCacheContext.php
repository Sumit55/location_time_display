<?php

namespace Drupal\location_time_display\CacheContext;

use Drupal\Core\Cache\Context\CacheContextInterface;
use Drupal\location_time_display\LocationTimeService;
use Drupal\Core\Cache\CacheableMetadata;

/**
 * Provides custom locationtime cache context.
 */
class LocationTimeCacheContext implements CacheContextInterface {

  /**
   * Location time service.
   *
   * @var \Drupal\location_time_display\LocationTimeService
   */
  protected $locationTime;

  /**
   * {@inheritdoc}
   */
  public function __construct(LocationTimeService $locationTime) {
    $this->location_time = $locationTime;
  }

  /**
   * {@inheritdoc}
   */
  public static function getLabel() {
    return t('Location time cache context');
  }

  /**
   * {@inheritdoc}
   */
  public function getContext() {
    $data = $this->location_time->getLocationtimeInTimezone();
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata() {
    return new CacheableMetadata();
  }

}
