## Introduction

This module provide a custom block "LocationTimeBlock" to display
location time, date and place according to timezone.

## Requirements

This module requires no modules outside of Drupal core.
## Installation

* Install the location time display module as you would normally install a
  contributed Drupal module. Visit https://www.drupal.org/node/1897420 for
  further information.

## Configuration

  Follow the Steps sequentially to configure settings form
  * Go to /admin/config/form/location/time/settings to set the values of the form.
  * Go to admin/structure/block and place block inside region.

* location_time_display.settings.yml resided at /config/install takes care of default value that prepoulated after module install and thorugh form you can make changes.
 
* LocationTimeService.php service that will return the current time based on the time zone selection in the above form. Time would be in the format 19th Sept 2022 - 11:15 AM.

* LocationTimeCacheContext.php resided at /CacheContext takes care of cache that the time would be updated without a cache rebuild.

## Maintainers

- Sumit Kumar - [sumit-k](https://www.drupal.org/u/sumit-k)
