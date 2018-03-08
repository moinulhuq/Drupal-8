<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Form plugin plugins.
 */
interface FormPluginInterface extends PluginInspectionInterface {

    /**
     * Return the id of the form.
     *
     * @return string
     */
    public function getId();

    /**
     * Return the label of the form.
     *
     * @return string
     */
    public function getLabel();

    /**
     * Builds the associated form.
     *
     * @return array().
     */
    public function getForm();

}
