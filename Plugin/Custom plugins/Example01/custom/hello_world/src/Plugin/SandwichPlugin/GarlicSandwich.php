<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\SandwichPlugin\GarlicSandwich.
 */

namespace Drupal\hello_world\Plugin\SandwichPlugin;

use Drupal\Core\Plugin\PluginBase;
use Drupal\hello_world\Plugin\SandwichPluginInterface;

/**
 * Provides a garlic sandwich.
 *
 * @Plugin(
 *   id = "garlic_sandwich",
 *   foobar = @Translation("This is an example value that is defined in the annotation."),
 *   calories = 420,
 * )
 */
class GarlicSandwich extends PluginBase implements SandwichPluginInterface {

  /**
   * Get a description of the sandwich fillings.
   */
  public function description() {
    return $this->t('I am garlic sandwich.');
  }

}
