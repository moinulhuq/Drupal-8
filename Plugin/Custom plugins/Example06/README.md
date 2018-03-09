Another example of Simple YAML based drupal 8 plugin.

Please note that 'createInstance' is used to create object of 'first' and 'second' class in the controller. 

For that we need to add 'class' => 'Drupal\hello_world\GeneralPluginBase' to provide default values for all general_plugin plugins in GeneralPluginManager.

```php
  protected $defaults = [
    // Add required and optional plugin properties.
    'id' => '',
    'label' => '',
    'class' => 'Drupal\hello_world\GeneralPluginBase',
  ];
```

Step02: Need to create 'GeneralPluginBase' as an normal class rather than abstract.

```php
class GeneralPluginBase extends PluginBase implements GeneralPluginInterface {
	...
}
```