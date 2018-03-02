<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ProductController.
 */
class ProductController extends ControllerBase {

  /**
   * Tv.
   *
   * @return string
   *   Return Hello string.
   */
  public function product() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: product')
    ];
  }

}
