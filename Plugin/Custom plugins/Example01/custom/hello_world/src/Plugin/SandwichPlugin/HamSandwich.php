<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\SandwichPlugin\HamSandwich.
 */

namespace Drupal\hello_world\Plugin\SandwichPlugin;

use Drupal\Core\Plugin\PluginBase;
use Drupal\hello_world\Plugin\SandwichPluginInterface;

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
