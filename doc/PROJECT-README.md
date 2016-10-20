# [Project name]

This project is [project description] at [project url] .

It is based on the erdfisch Drupal project template at
https://git.erdfisch.de/erdfisch/drupal-project .

The code for this repository is managed at
[project repository url] .

## Requirements

* PHP (at least 5.5.9) including the command-line binary
* A MySQL server and a corresponding user

## Installation

Follow these steps to create a new installation from scratch:

1. Install Composer dependencies:
   ```
   php composer.phar install
   ```
   For development it is preferable to download source repositories instead of
   tarballs:
   ```
   php composer.phar install --prefer-source
   ```

2. Initialize settings:

   * Copy example files:
      ```
      cd web
      cp sites/settings-local.example.php sites/settings-local.php
      cp sites/default/default.settings.php sites/default/settings.php
      ```

   * Update `sites/settings-local.php`:

     If this is not a development environment, adapt the include accordingly.

     Update the database connection in `sites/settings-local.php` to match your
     local environment.

     Specify a hash salt. This can be any non-empty string. To generate a hash
     salt like the Drupal installer would, run:
     ```
     ../bin/drush ev 'print \Drupal\Component\Utility\Crypt::randomBytesBase64(55) . PHP_EOL;'
     ```

   * Add the following line at the end of `sites/default/settings.php`:
     ```
     require __DIR__ . '/../settings-local.php';
     ```

3. Install Drupal
   ```
   ../bin/drush si config_installer --locale=de -y
   ```

4. Import translations
   ```
   ../bin/drush locale-check
   ../bin/drush locale-update
   ```
   (Unfortunately, this does not happen automatically as part of the `drush si`
   at the moment.)

## Updating

Follow these steps to update your installation after updating the codebase:

1. Update Composer dependencies
   ```
   php composer.phar install
   ```
   or
   ```
   php composer.phar install --prefer-source
   ```

2. Perform Drupal database updates
   ```
   cd web
   ../bin/drush updb -y
   ```

3. Import updated configuration
   ```
   ../bin/drush cim -y
   ```

4. Update translations
   ```
   ../bin/drush locale-check
   ../bin/drush locale-update
   ```
