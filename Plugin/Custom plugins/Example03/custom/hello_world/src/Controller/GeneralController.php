<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase implements ContainerInjectionInterface {

    protected $SandwichPluginManager;
    /**
     * Class constructor.
     */
    public function __construct($SandwichPluginManager) {
        $this->SandwichPluginManager = $SandwichPluginManager;
    }
    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('plugin.manager.sandwich_plugin')
        );
    }

    /**
    * Hello.
    *
    * @return array
    *   Return Plugin string.
    */
    public function hello() {

        $markup = "";
        $plugin = $this->SandwichPluginManager->createInstance('ham_sandwich');
        $markup .= "-> ".$plugin->description()." and my price = ".$plugin->getPrice()."<br>";

        $plugin = $this->SandwichPluginManager->createInstance('garlic_sandwich');
        $markup .= "-> ".$plugin->description()." and my price = ".$plugin->getPrice()."";

        return $build['intro'] = array(
            '#markup' => t($markup),
        );

    }
}
