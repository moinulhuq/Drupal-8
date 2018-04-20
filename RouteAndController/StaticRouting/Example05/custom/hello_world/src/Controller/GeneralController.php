<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;


/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    /**
   * Hello.
   *
   * @return array
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t("Hello world"),
    ];
  }

  public function access(){
      if (\Drupal::currentUser()->isAnonymous()) {
          // Return 403 Access Denied page.
          return AccessResult::forbidden();
      }
      return AccessResult::allowed();
  }

}
