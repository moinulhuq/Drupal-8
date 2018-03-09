<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    /**
    * Hello.
    *
    * @return array
    *   Return Plugin string.
    */
    public function hello() {

        $markup = "";

        $plugin  =  \Drupal::service('plugin.manager.sandwich_plugin')->createInstance('ham_sandwich');
        $markup .= "-> ".$plugin->description()." and my price = ".$plugin->getPrice()."<br>";

        $plugin  =  \Drupal::service('plugin.manager.sandwich_plugin')->createInstance('garlic_sandwich');
        $markup .= "-> ".$plugin->description()." and my price = ".$plugin->getPrice()."";

        return $build['intro'] = array(
            '#markup' => t($markup),
        );

    }
}