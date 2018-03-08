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

    // Check https://drupalize.me/blog/201409/unravelling-drupal-8-plugin-system

    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('login_form');
    $build['#title'] = $plugin->description();
    $build['form'] =  $plugin->getForm();

//    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('contact_form');
//    $build['#title'] = $plugin->description();
//    $build['form'] =  $plugin->getForm();

    return $build;
  }

}
