<?php

namespace Drupal\hello_world\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Sandwich plugin item annotation object.
 *
 * @see \Drupal\hello_world\Plugin\SandwichPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class SandwichPlugin extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The price of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $price;

}
