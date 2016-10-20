<?php

/**
 * @file
 * Drupal configuration file for staging environments.
 */

require $app_root . '/sites/settings-shared.php';

$settings['container_yamls'][] = $app_root . '/sites/services-stage.yml';
