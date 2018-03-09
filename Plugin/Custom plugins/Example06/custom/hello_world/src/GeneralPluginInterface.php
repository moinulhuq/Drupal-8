<?php

namespace Drupal\hello_world;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for general_plugin managers.
 */
interface GeneralPluginInterface {

    /**
     * Returns the id.
     *
     * @return string
     *   The id.
     */
    public function getId();

    /**
     * Returns the label.
     *
     * @return string
     *   The label.
     */
    public function getLabel();

}
