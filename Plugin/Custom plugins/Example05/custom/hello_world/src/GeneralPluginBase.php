<?php

namespace Drupal\hello_world;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Form plugin plugins.
 */
abstract class GeneralPluginBase extends PluginBase implements GeneralPluginInterface {

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->t($this->pluginDefinition['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(){
        return $this->t($this->pluginDefinition['label']);
    }
}