<?php

namespace Drupal\hello_world\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base class for Form plugin plugins.
 */
abstract class FormPluginBase extends PluginBase implements FormPluginInterface, ContainerFactoryPluginInterface {

    /**
     * The form builder.
     *
     * @var \Drupal\Core\Form\FormBuilder.
     */
    protected $formBuilder;

    /**
     * Class constructor.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, $form_builder) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->formBuilder = $form_builder;
    }
    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('form_builder')
        );
    }

    public function getId() {
        return $this->pluginDefinition['id'];
    }

    public function getLabel(){
        return $this->pluginDefinition['label'];
    }

    public function getForm(){
        return $this->formBuilder->getForm($this->pluginDefinition['form']);
    }

}
