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

    // Or

    $config = \Drupal::configFactory()->get('hello_world.settings');

    // Or

    $config = \Drupal::service('config.factory')->get('hello_world.settings');

    $markup =  $config->get('submit_button_label');

    return [
      '#type' => 'markup',
      '#markup' => $markup,
    ];
  }

    // Another option is to directly edit the config on the command line:

    // drush config-edit module_name.settings
}
