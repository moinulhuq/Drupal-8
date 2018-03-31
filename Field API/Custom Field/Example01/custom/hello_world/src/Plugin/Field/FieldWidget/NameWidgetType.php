<?php

namespace Drupal\hello_world\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'name_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "name_widget_type",
 *   label = @Translation("Name widget type"),
 *   field_types = {
 *     "name"
 *   }
 * )
 */
class NameWidgetType extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'name_size' => 60,
      'placeholder' => [
        'name' => '',
      ],
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $elements = [];

    $elements['name_size'] = [
      '#type' => 'number',
      '#title' => t('Name size'),
      '#default_value' => $this->getSetting('name_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['placeholder'] = [
      '#type' => 'details',
      '#title' => t('Placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    $elements['placeholder']['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => $this->getSetting('placeholder')['name'],
    ];

    return $elements;

  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = [];

    $summary[] = t('Name size: @name_size', ['@name_size' => $this->getSetting('name_size')]);

    if (!empty($this->getSetting('placeholder')['name'])) {

      $placeholder = $this->getSetting('placeholder')['name'];

      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $placeholder]);

    }

    return $summary;

  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['name'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->name) ? $items[$delta]->name : NULL,
      '#title' => t('Full Name'),
      '#size' => $this->getSetting('name_size'),
      '#placeholder' => $this->getSetting('placeholder')['name'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    return $element;

  }

}
