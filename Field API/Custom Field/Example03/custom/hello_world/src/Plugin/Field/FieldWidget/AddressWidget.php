<?php

namespace Drupal\hello_world\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'address_widget' widget.
 *
 * @FieldWidget(
 *   id = "address_widget",
 *   label = @Translation("Address widget"),
 *   field_types = {
 *     "address"
 *   }
 * )
 */
class AddressWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {

    $countries = \Drupal::service('country_manager')->getList();

    return [
        'address_one_size' => 60,
        'address_two_size' => 60,
        'city_size' => 60,
        'state_size' => 60,
        'postal_code_size' => 60,
        'country_size' => 60,
        'placeholder' => [
          'address_one' => '',
          'address_two' => '',
          'city' => '',
          'state' => '',
          'postal_code' => '',
          'country' => $countries,
        ],
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $elements = [];

    $elements['address_one_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Address One'),
      '#default_value' => $this->getSetting('address_one_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['address_two_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Address Two'),
      '#default_value' => $this->getSetting('address_two_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['city_size'] = [
      '#type' => 'number',
      '#title' => t('Size of City'),
      '#default_value' => $this->getSetting('city_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['state_size'] = [
      '#type' => 'number',
      '#title' => t('Size of State'),
      '#default_value' => $this->getSetting('state_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['postal_code_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Postal Code'),
      '#default_value' => $this->getSetting('postal_code_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['country_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Country'),
      '#default_value' => $this->getSetting('country_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['placeholder'] = [
      '#type' => 'details',
      '#title' => t('Placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    $elements['placeholder']['address_one'] = [
      '#type' => 'textfield',
      '#title' => t('Address One'),
      '#default_value' => $this->getSetting('placeholder')['address_one'],
    ];

    $elements['placeholder']['address_two'] = [
      '#type' => 'textfield',
      '#title' => t('Address Two'),
      '#default_value' => $this->getSetting('placeholder')['address_two'],
    ];

    $elements['placeholder']['city'] = [
      '#type' => 'select',
      '#title' => t('City'),
      '#default_value' => $this->getSetting('placeholder')['city'],
    ];

    $elements['placeholder']['state'] = [
      '#type' => 'textfield',
      '#title' => t('State'),
      '#default_value' => $this->getSetting('placeholder')['state'],
    ];

    $elements['placeholder']['postal_code'] = [
      '#type' => 'textfield',
      '#title' => t('Postal Code'),
      '#default_value' => $this->getSetting('placeholder')['postal_code'],
    ];

    $countries = \Drupal::service('country_manager')->getList();

    $elements['placeholder']['country'] = [
      '#type' => 'select',
      '#title' => t('Country'),
      '#options' => $countries,
      '#default_value' => $this->getSetting('placeholder')['country'],
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t(
      'Address One size: @address_one_size, 
      Address Two size: @address_two_size, 
      City size: @city_size, 
      State size: @state_size, 
      Postal Code size: @postal_code_size, 
      Country size: @country_size',
      [
        '@address_one_size' => $this->getSetting('address_one_size'),
        '@address_two_size' => $this->getSetting('address_two_size'),
        '@city_size' => $this->getSetting('city_size'),
        '@state_size' => $this->getSetting('state_size'),
        '@postal_code_size' => $this->getSetting('postal_code_size'),
        '@country_size' => $this->getSetting('country_size'),
      ]
    );

    if (!empty($this->getSetting('placeholder')['address_one']) ||
      !empty($this->getSetting('placeholder')['address_two']) ||
      !empty($this->getSetting('placeholder')['city']) ||
      !empty($this->getSetting('placeholder')['state']) ||
      !empty($this->getSetting('placeholder')['postal_code']) ||
      !empty($this->getSetting('placeholder')['country'])) {

      $placeholder =
        $this->getSetting('placeholder')['address_one'] . ', ' .
        $this->getSetting('placeholder')['address_two'] . ' ,' .
        $this->getSetting('placeholder')['city'] . ' ,' .
        $this->getSetting('placeholder')['state'] . ', ' .
        $this->getSetting('placeholder')['postal_code'] . ', ' ;

      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $placeholder]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $countries = \Drupal::service('country_manager')->getList();

    $placeholder = $this->getSetting('placeholder');

    $element['address_one'] = [
      '#type' => 'textfield',
      '#title' => t('Address One'),
      '#default_value' => isset($items[$delta]->address_one) ? $items[$delta]->address_one : NULL,
      '#size' => $this->getSetting('address_one_size'),
      '#placeholder' => $placeholder['address_one'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['address_two'] = [
      '#type' => 'textfield',
      '#title' => t('Address Two'),
      '#default_value' => isset($items[$delta]->address_two) ? $items[$delta]->address_two : NULL,
      '#size' => $this->getSetting('address_two_size'),
      '#placeholder' => $placeholder['address_two'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['city'] = [
      '#type' => 'select',
      '#title' => t('City'),
      '#options' => [],
      '#attributes' => ['id' => 'city'],
    ];

    $element['state'] = [
      '#type' => 'textfield',
      '#title' => t('State'),
      '#default_value' => isset($items[$delta]->state) ? $items[$delta]->state : NULL,
      '#size' => $this->getSetting('state_size'),
      '#placeholder' => $placeholder['state'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['postal_code'] = [
      '#type' => 'textfield',
      '#title' => t('Postal Code'),
      '#default_value' => isset($items[$delta]->postal_code) ? $items[$delta]->postal_code : NULL,
      '#size' => $this->getSetting('postal_code_size'),
      '#placeholder' => $placeholder['postal_code'],
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['country'] = [
      '#type' => 'select',
      '#title' => t('Country'),
      '#options' => $countries,
      '#ajax' => [
        'callback' => [get_class($this), 'validateNameAjax'],
        'wrapper' => 'city',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Populating...'),
        ),
      ],
      '#default_value' => isset($items[$delta]->country) ? $items[$delta]->country :  $placeholder['country'],
    ];

    return $element;
  }

  /**
   * Ajax callback to validate the Name.
   */
  function validateNameAjax(array &$form, FormStateInterface $form_state) {

    $form['city'] = [
      '#type' => 'select',
      '#options' => \Drupal\hello_world\Plugin\Field\FieldWidget\AddressWidget::options($form_state->getTriggeringElement()['#value']),
      '#attributes' => ['id' => 'city'],
    ];

    return $form['city'];
  }

  public function options($code){
    switch ($code) {
      case "BD":
        return ['dk'=>'Dhaka', 'ctg'=> 'chittagong'];
        break;
      case "AF":
        return ['af'=>'afgaan', 'mf'=> 'maafgaan'];
        break;
      default:
        return ['no' => 'No data'];
    }
  }

}
