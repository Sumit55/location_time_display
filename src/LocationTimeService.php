<?php

namespace Drupal\location_time_display;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DateFormatterInterface;

/**
 * Provides a service for handling locationtime operations.
 */
class LocationTimeService {


  /**
   * The datetime.time service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $datetimeTime;
  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;
  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs a new LocationDatetimeService object.
   *
   * @param \Drupal\Component\Datetime\TimeInterface $datetime_time
   *   The datetime.time service.
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   *   The config.factory service.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $dateFormatter
   *   The config.factory service.
   */
  public function __construct(TimeInterface $datetime_time, ConfigFactory $configFactory, DateFormatterInterface $dateFormatter) {
    $this->datetimeTime = $datetime_time;
    $this->configFactory = $configFactory;
    $this->dateFormatter = $dateFormatter;

  }

  /**
   * Get the current datetime in a specific timezone.
   *
   * @return string
   *   The formatted current datetime.
   */
  public function getLocationtimeInTimezone() {
    $timezone = $this->configFactory->get('location_time_display.settings')->get('timezone');
    $timestamp = $this->datetimeTime->getRequestTime();
    $formatted_datetime = $this->dateFormatter->format($timestamp, 'custom', 'jS M Y - g:i A', $timezone);
    return $formatted_datetime;
  }

}
