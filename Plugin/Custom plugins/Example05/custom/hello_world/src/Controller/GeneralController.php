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
    $plugin  =  \Drupal::service('plugin.manager.general_plugin')->getDefinition('first');
    $markup .= "-> Id: ".$plugin['id']." and Label: ". $plugin['label']."<br>";

    $plugin  =  \Drupal::service('plugin.manager.general_plugin')->getDefinition('second');
    $markup .= "-> Id: ".$plugin['id']." and Label: ". $plugin['label']."<br>";

    return [
      '#type' => 'markup',
      '#markup' => $markup,
    ];

  }

}
