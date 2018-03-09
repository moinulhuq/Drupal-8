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
   *   Return Hello string.
   */
  public function hello() {

    $markup = "";
    $plugin  =  \Drupal::service('plugin.manager.general_plugin')->createInstance('first');
    $markup .= "-> Id: ".$plugin->getId()." and Label: ".$plugin->getLabel()."<br>";

    $plugin  =  \Drupal::service('plugin.manager.general_plugin')->createInstance('second');
    $markup .= "-> Id: ".$plugin->getId()." and Label: ".$plugin->getLabel()."<br>";

    return [
      '#type' => 'markup',
      '#markup' => $markup,
    ];

  }

}
