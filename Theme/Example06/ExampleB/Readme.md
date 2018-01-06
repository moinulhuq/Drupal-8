To use "logo.png" or something else, you can add myth.theme. To do this, add the following lines to  theme/myth/myth.theme file in your theme folder. Then clear the cache. You will see the effect.

myth.theme
----------
```php
<?php
/**
 * @file
 * Bootstrap sub-theme.
 *
 * Place your custom PHP code in this file.
 */

/**
 * Implements THEME_preprocess_HOOK() for block templates.
 */
function myth_preprocess_block(&$variables) {

  switch ($variables['base_plugin_id']) {

    case 'system_branding_block':
      $variables['site_logo'] = '';

      if ($variables['content']['site_logo']['#access'] && $variables['content']['site_logo']['#uri']) {
        $variables['site_logo'] = str_replace('.svg', '.png', $variables['content']['site_logo']['#uri']);
      }

      break;
  }

}
```