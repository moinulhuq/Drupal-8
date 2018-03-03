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
  public function hello($id, $name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('from general controller and parameter id = '. $id. " and name = ".$name),
    ];
  }

}
