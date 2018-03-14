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
   *   Return Hello string.
   */
  public function hello(){

      // Built in configuration "System maintanance messgae" change
      $config = \Drupal::service('config.factory')->getEditable('system.maintenance');
      $config->set('message', 'hello')->save();
      $message = $config->get('message');

      // Built in configuration "System performance cache max_age" change
      $config = \Drupal::service('config.factory')->getEditable('system.performance');
      $config->set('cache.page.max_age', 1)->save();
      $message = $config->get('cache.page.max_age');

      // Built in configuration "System site name" change
      $config = \Drupal::service('config.factory')->getEditable('system.site');
      $config->set('name', 'University Service')->save();
      $message = $config->get('name');

      // Clear or delete "System site name"
      $config = \Drupal::service('config.factory')->getEditable('system.site');

      // Remove single value from configuration object.
      $config->clear('name')->save();

      // Remove entire configuration object.
      $config->delete();

      $message = $config->get('name');

      return [
          '#type' => 'markup',
          '#markup' => $message,
      ];
  }
}
