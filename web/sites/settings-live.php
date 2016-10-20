<?php

/**
 * @file
 * Drupal configuration file for live environments.
 */

require $app_root . '/sites/settings-shared.php';

$settings['container_yamls'][] = $app_root . '/sites/services-live.yml';
