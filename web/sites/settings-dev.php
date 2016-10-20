<?php

/**
 * @file
 * Drupal configuration file for development environments.
 */

require $app_root . '/sites/settings-shared.php';

$settings['container_yamls'][] = $app_root . '/sites/services-dev.yml';

// Include the upstream development settings.
require $app_root . '/sites/example.settings.local.php';
