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

        $car_list  = \Drupal::service('hello_world.toyota');

        $render = "<div>";
        foreach ($car_list->getCar() as $serial => $car){
            $render .= "<b>".$serial."</b><div>".$car['company']."</div>";
            $render .= "<div>".$car['origin']."</div>";
            $render .= "<div>".$car['url']."</div>";
        }
        $render .= "</div>";

        return [
          '#type' => 'markup',
          '#markup' => $render,
        ];
    }
}
