<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return form.
   */
  public function hello() {

    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('login_form');
    $build['#title'] = $plugin->description();
    $build['form'] =  $plugin->getForm();

//    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('contact_form');
//    $build['#title'] = $plugin->description();
//    $build['form'] =  $plugin->getForm();

    return $build;
  }

}
