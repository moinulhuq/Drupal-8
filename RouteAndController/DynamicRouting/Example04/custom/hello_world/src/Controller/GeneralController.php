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
      '#markup' => $this->t('Try "hello_world/hello/article" or "hello_world/hello/page"'),
    ];
  }

  /**
   * Dynamic Hello.
   *
   * @return array
   *   Return Dynamic Hello string.
   */
  public function dynamicContent($content_type){
    return [
      '#type' => 'markup',
      '#markup' => $this->t($content_type),
    ];
  }

}
