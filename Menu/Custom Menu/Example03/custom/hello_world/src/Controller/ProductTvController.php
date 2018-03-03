<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ProductController.
 */
class ProductTvController extends ControllerBase {

  /**
   * Tv.
   *
   * @return string
   *   Return Hello string.
   */
  public function tv() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: tv')
    ];
  }

}
