<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase
{

  /**
   * Hello.
   *
   * @return array
   *   Return Hello string.
   */
  public function hello(){
    return [
      '#type' => 'markup',
      '#markup' => $this->t('From Hello'),
    ];
  }

  /**
   * Dynamic Hello.
   *
   * @return array
   *   Return Dynamic Hello string.
   */
  public function dynamichello(){
    return [
      '#type' => 'markup',
      '#markup' => $this->t('From Dynamic Hello'),
    ];
  }

}
