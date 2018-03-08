<?php

namespace Drupal\hello_world\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Form plugin item annotation object.
 *
 * @see \Drupal\hello_world\Plugin\FormPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class FormPlugin extends Plugin {

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
   * The form class associated with this plugin
   *
   * It must implement \Drupal\hello_world\Plugin\FormPluginInterface.
   *
   * @var string
   */
   public $form;

}
