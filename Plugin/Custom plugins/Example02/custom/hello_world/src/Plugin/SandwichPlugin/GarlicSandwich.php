<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\SandwichPlugin\GarlicSandwich.
 */

namespace Drupal\hello_world\Plugin\SandwichPlugin;

use Drupal\Core\Plugin\PluginBase;
use Drupal\hello_world\Plugin\SandwichPluginInterface;
use Drupal\hello_world\Plugin\SandwichPluginBase;

/**
 * Provides a garlic sandwich.
 *
 * @SandwichPlugin(
 *   id = "garlic_sandwich",
 *   label = @Translation("This is an example value that is defined in the annotation."),
 * )
 */
class GarlicSandwich extends SandwichPluginBase implements SandwichPluginInterface {

    /**
     * Get a price of garlic sandwich.
     */
    public function getPrice() {
        $price = 420;
        return $price;
    }

    /**
    * Get a description of the sandwich fillings.
    *
    */
    public function description() {
        return 'I am garlic sandwich';
    }

}
