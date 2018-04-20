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
        return [
          '#type' => 'markup',
          '#markup' => $this->t("from index"),
        ];
    }

    /**
     * hellosubpage().
     *
     * @return array
     *   Return Hello string.
     */
    public function hellosubpage() {
        return [
            '#type' => 'markup',
            '#markup' => $this->t("from sub page"),
        ];
    }

    /**
     * hellosubpageparam().
     *
     * @return array
     *   Return Hello string.
     */
    public function hellosubpageparam($param) {
        return [
            '#type' => 'markup',
            '#markup' => $this->t("from sub page with param = ". $param),
        ];
    }


}
