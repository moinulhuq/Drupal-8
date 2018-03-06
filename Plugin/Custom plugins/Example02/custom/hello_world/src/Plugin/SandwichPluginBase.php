<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Sandwich plugin plugins.
 */
abstract class SandwichPluginBase extends PluginBase implements SandwichPluginInterface {

    public function getName() {
        return $this->pluginDefinition['name'];
    }

    public function getPrice() {
        return $this->pluginDefinition['price'];
    }

    public function slogan() {
        return t('For Sandwich lover');
    }

}
