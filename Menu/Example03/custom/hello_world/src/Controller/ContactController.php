<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ContactController.
 */
class ContactController extends ControllerBase {

  /**
   * Contact.
   *
   * @return string
   *   Return Hello string.
   */
  public function contact() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: contact')
    ];
  }

}
