<?php

namespace Drupal\hello_world\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'full_name_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "full_name_widget_type",
 *   label = @Translation("Full name widget type"),
 *   field_types = {
 *     "full_name"
 *   }
 * )
 */
class FullNameWidgetType extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'first_name_size' => 60,
      'middle_name_size' => 30,
      'last_name_size' => 60,
      'placeholder' => [
        'first_name' => '',
        'middle_name' => '',
        'last_name' => '',
      ],
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $elements = [];

    $elements['first_name_size'] = [
      '#type' => 'number',
      '#title' => t('First name size'),
      '#default_value' => $this->getSetting('first_name_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['middle_name_size'] = [
      '#type' => 'number',
      '#title' => t('Middle name size'),
      '#default_value' => $this->getSetting('middle_name_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['last_name_size'] = [
      '#type' => 'number',
      '#title' => t('Last name size'),
      '#default_value' => $this->getSetting('last_name_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['placeholder'] = [
      '#type' => 'details',
      '#title' => t('Placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    $elements['placeholder']['first_name'] = [
      '#type' => 'textfield',
      '#title' => t('First name'),
      '#default_value' => $this->getSetting('placeholder')['first_name'],
    ];

    $elements['placeholder']['middle_name'] = [
      '#type' => 'textfield',
      '#title' => t('Middle name'),
      '#default_value' => $this->getSetting('placeholder')['middle_name'],
    ];

    $elements['placeholder']['last_name'] = [
      '#type' => 'textfield',
      '#title' => t('Last name'),
      '#default_value' => $this->getSetting('placeholder')['last_name'],
    ];

    return $elements;

  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = [];

    $summary[] = t('First name size: @first_name_size, Middle name size @middle_name_size and Last name size @last_name_size', ['@first_name_size' => $this->getSetting('first_name_size'), '@middle_name_size' => $this->getSetting('middle_name_size'), '@last_name_size' => $this->getSetting('last_name_size')]);

    $placeholder_settings = $this->getSetting('placeholder');

    if (!empty($this->getSetting('placeholder')['first_name']) && !empty($this->getSetting('placeholder')['middle_name']) && !empty($this->getSetting('placeholder')['last_name'])) {
      $placeholder = $placeholder_settings['first_name'] . ' ' .$placeholder_settings['middle_name']. ' ' .$placeholder_settings['last_name'];
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $placeholder]);
    }

    return $summary;

  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $placeholder_settings = $this->getSetting('placeholder');

    $element['fname'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->fname) ? $items[$delta]->fname : NULL,
      '#title' => t('First Name'),
      '#size' => $this->getSetting('first_name_size'),
      '#placeholder' => $placeholder_settings['first_name'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['mname'] = [
        '#type' => 'textfield',
        '#default_value' => isset($items[$delta]->mname) ? $items[$delta]->mname : NULL,
        '#title' => t('Middle Name'),
        '#size' => $this->getSetting('middle_name_size'),
        '#placeholder' => $placeholder_settings['middle_name'],
        '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['lname'] = [
        '#type' => 'textfield',
        '#default_value' => isset($items[$delta]->lname) ? $items[$delta]->lname : NULL,
        '#title' => t('Last Name'),
        '#size' => $this->getSetting('last_name_size'),
        '#placeholder' => $placeholder_settings['last_name'],
        '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    return $element;

  }

}
