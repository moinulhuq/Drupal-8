<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DefaultController.
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

      $simple_message_configs = \Drupal::service('entity_type.manager')->getStorage('simple_message')->loadMultiple();

      foreach ($simple_message_configs as $simple_message_config){
          $markup .= $simple_message_configs[$simple_message_config->id()]->message."<br>";
      }

      return [
          '#type' => 'markup',
          '#markup' => $markup,
      ];

  }

}
