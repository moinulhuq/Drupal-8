<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class AboutController.
 */
class AboutController extends ControllerBase {

  /**
   * About.
   *
   * @return string
   *   Return Hello string.
   */
  public function about() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: about')
    ];
  }

}
