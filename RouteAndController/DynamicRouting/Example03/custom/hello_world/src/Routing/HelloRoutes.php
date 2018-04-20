<?php

/**
* @file
* Contains \Drupal\hello_world\Routing\HelloRoutes.
*/

namespace Drupal\hello_world\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
* Defines dynamic routes.
*/
class HelloRoutes {

    /**
    * {@inheritdoc}
    */
    public function routes(){

      $route_collection = new RouteCollection();

      $route = new Route(
    // Route Path:
        '/hello_world/hello',
    // Route defaults:
        array(
          '_controller' => '\Drupal\hello_world\Controller\GeneralController::dynamichello',
          '_title' => 'From Dynamic route'
        ),
    // Route requirements:
        array(
          '_permission' => 'access content',
        )
      );

      $route_collection->add('hello_world.general_controller_dynamichello', $route);

      return $route_collection;

    }

}