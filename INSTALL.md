# Install instructions

Configured system

    drush si config_installer -y --notify --db-url=mysql://username:password@localhost/database

Default content

    drush en dbcd_default_content -y && drush pmu dbcd_default_content -y
