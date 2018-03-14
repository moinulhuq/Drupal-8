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

    $config =  \Drupal::config('hello_world.settings');

    $markup =  $config->get('message');

    // Change the settings value of settings.yml file
    $config = \Drupal::service('config.factory')->getEditable('hello_world.settings');

    $config->set('message', 'Hi')->save();

    $markup =  $config->get('message');

    return [
      '#type' => 'markup',
      '#markup' => $markup,
    ];
  }

}
