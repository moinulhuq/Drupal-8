Disable Drupal 8 caching and Enable twig debug

1. Copy and rename the sites/example.settings.local.php to sites/default/settings.local.php:

terminal
--------
```
~/Sites/uniservice/sites$> cp example.settings.local.php default/settings.local.php
```

2. Open "settings.php" file in sites/default and uncomment these lines:

settings.php
------------
```php
if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
```

This will include the local settings file as part of Drupal's settings file.

3. Open "settings.local.php" and uncomment (or add) this line to enable the null cache service:

settings.local.php
------------------
```php
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
```

By default development.services.yml contains the settings to disable Drupal caching:

development.services.yml
------------------------
```yml
services:
  cache.backend.null:
    class: Drupal\Core\Cache\NullBackendFactory
```

NOTE: Do not create development.services.yml, it exists under /sites

4. In "settings.local.php" change the following to be TRUE if you want to work with enabled css- and js-aggregation:

settings.local.php
------------------
```php
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
```

5. Uncomment these lines in "settings.local.php" to disable the render cache and disable dynamic page cache:

settings.local.php
------------------
```php
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
```

If you are using Drupal version greater than or equal to 8.4 then add the following lines to your "settings.local.php"

settings.local.php
------------------
```php
$settings['cache']['bins']['page'] = 'cache.backend.null';
```

If you do not want to install test modules and themes, set the following to FALSE:

settings.local.php
------------------
```php
$settings['extension_discovery_scan_tests'] = FALSE;
```

6. Open "development.services.yml" in the sites folder and add the following block to disable the twig cache:

development.services.yml
------------------------
```yml
parameters:
  twig.config:
    debug: true
    auto_reload: true
    cache: false
```

NOTE: If the parameters block is already present in the yml file, append the twig.config block to it.

7. Afterwards you have to rebuild the Drupal cache otherwise your website will encounter an unexpected error on page reload. This can be done by with drush:

terminal
--------
```
~/Sites/uniservice$> drush cr
```

or by visiting the following URL from your Drupal 8 website:

http://yoursite/core/rebuild.php

Now you should be able to develop in Drupal 8 without manual cache rebuilds on a regular basis.

Your final "development.services.yml" should look as follows (mind the indentation):

development.services.yml
------------------------
```yml
# Local development services.
#
# To activate this feature, follow the instructions at the top of the
# 'example.settings.local.php' file, which sits next to this file.
parameters:
  http.response.debug_cacheability_headers: true
  twig.config:
    debug: true
    auto_reload: true
    cache: false
services:
  cache.backend.null:
    class: Drupal\Core\Cache\NullBackendFactory
```
