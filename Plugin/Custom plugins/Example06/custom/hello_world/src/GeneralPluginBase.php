<?php

namespace Drupal\hello_world;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Form plugin plugins.
 */
class GeneralPluginBase extends PluginBase implements GeneralPluginInterface {

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->pluginDefinition['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(){
        return $this->pluginDefinition['label'];
    }
}