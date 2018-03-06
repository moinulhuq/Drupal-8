<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Sandwich plugin plugins.
 */
interface SandwichPluginInterface extends PluginInspectionInterface {

    /**
     * Return the name of the Sandwich.
     *
     * @return string
     */
    public function getName();

    /**
     * Return the price of Sandwich.
     *
     * @return float
     */
    public function getPrice();

    /**
     * A slogan for the Sandwich.
     *
     * @return string
     */
    public function slogan();

}
