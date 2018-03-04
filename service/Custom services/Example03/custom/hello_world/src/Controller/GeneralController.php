<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    /**
    * car().
    *
    * @return array
    *   Return Hello string.
    */
    public function car() {

        $car  = \Drupal::service('hello_world.toyota');
        $foo = "bar";
        return [
          '#type' => 'markup',
          '#markup' => $car->getCar(),
        ];
    }
}
