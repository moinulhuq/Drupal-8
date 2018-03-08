<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Form plugin plugin manager.
 */
class FormPluginManager extends DefaultPluginManager {

  /**
   * Constructs a new FormPluginManager object.
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
    parent::__construct('Plugin/FormPlugin', $namespaces, $module_handler, 'Drupal\hello_world\Plugin\FormPluginInterface', 'Drupal\hello_world\Annotation\FormPlugin');

    $this->alterInfo('hello_world_form_plugin_info');
    $this->setCacheBackend($cache_backend, 'hello_world_form_plugin_plugins');
  }

}
