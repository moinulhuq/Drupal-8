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

      $routes['hello_world.general_controller_dynamichello'] = new Route(
    // Route Path:
        '/hello_world/hello',
    // Route defaults:
        array(
          '_controller' => '\Drupal\hello_world\Controller\GeneralController::hello',
          '_title' => 'Overwriting Title of Hello'
        ),
    // Route requirements:
        array(
          '_permission' => 'access content',
        )
      );

      return $routes;

    }

}