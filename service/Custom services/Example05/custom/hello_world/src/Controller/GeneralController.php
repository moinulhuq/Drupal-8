<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    // Check https://www.sitepoint.com/building-drupal-8-module-configuration-management-service-container/

    protected $car_list;

    /**
     * Class constructor.
     */
    public function __construct($ToyotaService) {
        $this->car_list = $ToyotaService;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('hello_world.toyota')
        );
    }

    /**
    * car().
    *
    * @return array
    *   Return rendered array.
    */
    public function car() {

        $render = "<div>";
        foreach ($this->car_list->getCar() as $serial => $car){
            $render .= "<b>".$serial."</b><div>".$car['company']."</div>";
            $render .= "<div>".$car['origin']."</div>";
            $render .= "<div>".$car['url']."</div>";
        }
        $render .= "</div>";

        return [
          '#type' => 'markup',
          '#markup' => $render,
        ];
    }
}
