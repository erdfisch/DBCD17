<?php

/**
 * @file
 * Shared Drupal configuration file for all environments.
 */

$settings['container_yamls'][] = $app_root . '/sites/services-shared.yml';

$settings['install_profile'] = 'config_installer';

$config_directories['active'] = '../environment/config/active';
$config_directories['sync'] = '../environment/config/sync';
