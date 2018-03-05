Simple Plugin system in Drupal 8. To create plugin follow the steps

If you are using drupal console

```
generate:plugin:type:annotation
```

Otherwise

Step01: Define the plugin type as service in the 'hello_world.services.yml' file

```yml
services:
  plugin.manager.sandwich_plugin:
    class: Drupal\hello_world\Plugin\SandwichPluginManager
    parent: default_plugin_manager
```

Step02:  Create an interface for the new plugin type. 'hello_world/src/Plugin/SandwichPluginInterface.php'

```php
interface SandwichPluginInterface extends PluginInspectionInterface {

    /**
     * Provide a description of the sandwich.
     *
     * @return string
     *   A string description of the sandwich.
     */
    public function description();
}
```

Step03:  Create a new Plugin Manager. 'hello_world/src/Plugin/SandwichPluginManager.php'

```php
class SandwichPluginManager extends DefaultPluginManager {

  /**
   * Constructs a new SandwichPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/SandwichPlugin', $namespaces, $module_handler, 'Drupal\hello_world\Plugin\SandwichPluginInterface', 'Drupal\Component\Annotation\Plugin');

    $this->alterInfo('hello_world_sandwich_plugin_info');
    $this->setCacheBackend($cache_backend, 'hello_world_sandwich_plugin_plugins');
  }
}
```

Step04: Now Create a new plugin. 'hello_world/src/Plugin/SandwichPlugin/GarlicSandwich.php' and 'hello_world/src/Plugin/SandwichPlugin/HamSandwich.php'

```php
/**
 * Provides a ham sandwich.
 *
 * @Plugin(
 *   id = "ham_sandwich",
 *   foobar = @Translation("This is an example value that is defined in the annotation."),
 *   calories = 426,
 * )
 */
class HamSandwich extends PluginBase implements SandwichPluginInterface {

  /**
   * Get a description of the sandwich fillings.
   */
  public function description() {
    return $this->t('I am ham sandwich.');
  }

}
```

Now you are done. It time to call your plugin. we will do it using the controller. 'hello_world/src/Controller/GeneralController.php'

```php
class GeneralController extends ControllerBase {

    /**
    * Hello.
    *
    * @return array
    *   Return Plugin string.
    */
    public function hello() {

        $markup = "";

        $plugin  =  \Drupal::service('plugin.manager.sandwich_plugin')->createInstance('ham_sandwich');
        $markup .= "-> ".$plugin->description()."<br>";

        $plugin  =  \Drupal::service('plugin.manager.sandwich_plugin')->createInstance('garlic_sandwich');
        $markup .= "-> ".$plugin->description()."";

        return $build['intro'] = array(
            '#markup' => t($markup),
        );

    }
}
```