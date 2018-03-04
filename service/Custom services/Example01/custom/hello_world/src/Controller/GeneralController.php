<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    /**
    * hello().
    *
    * @return array
    *   Return Hello string.
    */
    public function hello() {

        $data  = \Drupal::service('hello_world.default');

        return [
          '#type' => 'markup',
          '#markup' => $this->t("Service said = ".$data->getHello()),
        ];
    }
}
