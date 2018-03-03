<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ShowController.
 */
class ShowController extends ControllerBase {

  /**
   * Show.
   *
   * @return string
   *   Return Hello string.
   */
  public function show($show) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: show: '. $show)
    ];
  }

}
