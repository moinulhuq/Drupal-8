<?php

/**
* @file
* Contains \Drupal\hello_world\Routing\HelloRoutes.
*/

namespace Drupal\hello_world\Routing;

use Symfony\Component\Routing\Route;

/**
* Defines dynamic routes.
*/
class HelloRoutes {

    /**
    * {@inheritdoc}
    */
    public function routes(){

      $routes = array();

      $content_types = \Drupal::service('entity.manager')->getStorage('node_type')->loadMultiple();

      foreach ($content_types as $content_type) {

      $routes['hello_world.general_controller_dynamichello'.$content_type->id()] = new Route(
      // Route Path:
        '/hello_world/hello/'. $content_type->id(),
        // Route defaults:
        array(
          '_controller' => '\Drupal\hello_world\Controller\GeneralController::dynamicContent',
          '_title' => 'Content type : '.$content_type->label(),
          'content_type' => $content_type->id(),
        ),
        // Route requirements:
        array(
          '_permission' => 'access content',
        )
      );

    }
      return $routes;

    }

}