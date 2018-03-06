<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\SandwichPlugin\HamSandwich.
 */

namespace Drupal\hello_world\Plugin\SandwichPlugin;

use Drupal\Core\Plugin\PluginBase;
use Drupal\hello_world\Plugin\SandwichPluginInterface;
use Drupal\hello_world\Plugin\SandwichPluginBase;

/**
 * Provides a ham sandwich.
 *
 * @SandwichPlugin(
 *   id = "ham_sandwich",
 *   label = @Translation("This is an example value that is defined in the annotation."),
 * )
 */
class HamSandwich extends SandwichPluginBase implements SandwichPluginInterface {

    /**
     * Get a price of ham sandwich.
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
        return 'I am ham sandwich';
    }

}
