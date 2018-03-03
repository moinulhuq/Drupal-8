<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ProductController.
 */
class ProductLaptopController extends ControllerBase {

  /**
   * Tv.
   *
   * @return string
   *   Return Hello string.
   */
  public function laptop() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: laptop')
    ];
  }

}
