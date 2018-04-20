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
      '#markup' => $this->t('Dynamic Page title'),
    ];
  }

  /**
   * Title of the Page.
   *
   * @return string
   *   Return title of the Page.
   */
  public function title(){

//    return $this->t('Hello world dynamic page title');

//    or

    return  \Drupal::config('system.site')->get('slogan');
  }

}
