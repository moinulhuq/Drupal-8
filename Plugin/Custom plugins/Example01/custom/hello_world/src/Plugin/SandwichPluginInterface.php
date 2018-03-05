<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Sandwich plugin plugins.
 */
interface SandwichPluginInterface extends PluginInspectionInterface {

    /**
     * Provide a description of the sandwich.
     *
     * @return string
     *   A string description of the sandwich.
     */
    public function description();

}
