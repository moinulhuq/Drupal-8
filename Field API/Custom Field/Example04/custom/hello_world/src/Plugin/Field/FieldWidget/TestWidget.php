<?php

namespace Drupal\hello_world\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItemInterface;

/**
 * Plugin implementation of the 'test_widget' widget.
 *
 * @FieldWidget(
 *   id = "test_widget",
 *   label = @Translation("Test widget"),
 *   field_types = {
 *     "test"
 *   }
 * )
 */
class TestWidget extends WidgetBase implements DateTimeItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'name_size' => 60,
        'score_size' => 60,
        'cash_size' => 60,
        'male_size' => 60,
        'link_size' => 60,
        'email_size' => 60,
        'options_size' => 60,
        'startdate_size' => 60,
        'placeholder' => [
          'name' => '',
          'score' => '',
          'cash' => '',
          'male' => TRUE,
          'link' => '',
          'email' => '',
          'options' => '',
          'startdate' => '',
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
      '#title' => t('Size of Name'),
      '#default_value' => $this->getSetting('name_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['score_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Score'),
      '#default_value' => $this->getSetting('score_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['cash_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Cash'),
      '#default_value' => $this->getSetting('cash_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['male_size'] = [
      '#type' => 'number',
      '#title' => t('Size of male'),
      '#default_value' => $this->getSetting('male_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['link_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Link'),
      '#default_value' => $this->getSetting('link_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['email_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Email'),
      '#default_value' => $this->getSetting('email_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['options_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Options'),
      '#default_value' => $this->getSetting('options_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['startdate_size'] = [
      '#type' => 'number',
      '#title' => t('Size of Start Date'),
      '#default_value' => $this->getSetting('startdate_size'),
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

    $elements['placeholder']['score'] = [
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => $this->getSetting('placeholder')['score'],
    ];

    $elements['placeholder']['cash'] = [
      '#type' => 'textfield',
      '#title' => t('Cash'),
      '#default_value' => $this->getSetting('placeholder')['cash'],
    ];

    $elements['placeholder']['male'] = [
      '#type' => 'checkbox',
      '#title' => t('male'),
      '#default_value' => $this->getSetting('placeholder')['male'],
    ];

    $elements['placeholder']['link'] = [
      '#type' => 'url',
      '#title' => t('URL'),
      '#default_value' => $this->getSetting('placeholder')['link'],
    ];

    $elements['placeholder']['email'] = [
      '#type' => 'email',
      '#title' => t('Email'),
      '#default_value' => $this->getSetting('placeholder')['email'],
    ];

    $elements['placeholder']['options'] = [
      '#type' => 'textfield',
      '#title' => t('Options'),
      '#default_value' => $this->getSetting('placeholder')['options'],
    ];

    $elements['placeholder']['startdate'] = [
      '#type' => 'date',
      '#title' => t('Start Date'),
      '#default_value' => $this->getSetting('placeholder')['startdate'],
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t(
      'Name size: @name_size,
      Score size: @score_size,
      Cash size: @cash_size,
      male size: @male_size,
      link size: @link_size,
      email size: @email_size,
      options size: @options_size,
      Start date size: @startdate_size,
      
      ',
      [
        '@name_size' => $this->getSetting('name_size'),
        '@score_size' => $this->getSetting('score_size'),
        '@cash_size' => $this->getSetting('cash_size'),
        '@male_size' => $this->getSetting('male_size'),
        '@link_size' => $this->getSetting('link_size'),
        '@email_size' => $this->getSetting('email_size'),
        '@options_size' => $this->getSetting('options_size'),
        '@startdate_size' => $this->getSetting('startdate_size'),

      ]);
    if (
      !empty($this->getSetting('placeholder')['name']) ||
      !empty($this->getSetting('placeholder')['score']) ||
      !empty($this->getSetting('placeholder')['cash']) ||
      !empty($this->getSetting('placeholder')['male']) ||
      !empty($this->getSetting('placeholder')['link']) ||
      !empty($this->getSetting('placeholder')['email']) ||
      !empty($this->getSetting('placeholder')['options']) ||
      !empty($this->getSetting('placeholder')['startdate'])

    ) {
      $placeholder =
        $this->getSetting('placeholder')['name'] . ', '.
        $this->getSetting('placeholder')['score'] . ', '.
        $this->getSetting('placeholder')['cash'] . ', '.
        $this->getSetting('placeholder')['male'] . ', '.
        $this->getSetting('placeholder')['link'] . ', '.
        $this->getSetting('placeholder')['email'] . ', '.
        $this->getSetting('placeholder')['options'] . ', '.
        $this->getSetting('placeholder')['startdate'] . ', '
      ;

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
      '#title' => 'Name',
      '#default_value' => isset($items[$delta]->name) ? $items[$delta]->name : NULL,
      '#size' => $this->getSetting('name_size'),
      '#placeholder' => $this->getSetting('placeholder')['name'],
      '#maxlength' => $this->getFieldSetting('name_max_length'),
    ];

    $element['score'] = [
      '#type' => 'textfield',
      '#title' => 'Score',
      '#default_value' => isset($items[$delta]->score) ? $items[$delta]->score : NULL,
      '#size' => $this->getSetting('score_size'),
      '#placeholder' => $this->getSetting('placeholder')['score'],
      '#maxlength' => $this->getFieldSetting('score_max_length'),
    ];

    $element['cash'] = [
      '#type' => 'textfield',
      '#title' => 'Cash',
      '#default_value' => isset($items[$delta]->cash) ? $items[$delta]->cash : NULL,
      '#size' => $this->getSetting('cash_size'),
      '#placeholder' => $this->getSetting('placeholder')['cash'],
      '#maxlength' => $this->getFieldSetting('cash_max_length'),
    ];

    $element['male'] = [
      '#type' => 'checkbox',
      '#title' => 'Male',
      '#default_value' => isset($items[$delta]->male) ? $items[$delta]->male : NULL,
      '#size' => $this->getSetting('male_size'),
      '#placeholder' => $this->getSetting('placeholder')['male'],
      '#maxlength' => $this->getFieldSetting('male_max_length'),
    ];

    $element['link'] = [
      '#type' => 'url',
      '#title' => 'Link',
      '#default_value' => isset($items[$delta]->link) ? $items[$delta]->link : NULL,
      '#size' => $this->getSetting('link_size'),
      '#placeholder' => $this->getSetting('placeholder')['link'],
      '#maxlength' => $this->getFieldSetting('link_max_length'),
    ];

    $element['email'] = [
      '#type' => 'email',
      '#title' => 'Email',
      '#default_value' => isset($items[$delta]->email) ? $items[$delta]->email : NULL,
      '#size' => $this->getSetting('email_size'),
      '#placeholder' => $this->getSetting('placeholder')['email'],
      '#maxlength' => $this->getFieldSetting('email_max_length'),
    ];

    $element['options'] = [
      '#type' => 'textfield',
      '#title' => 'Options',
      '#default_value' => isset($items[$delta]->options) ? $items[$delta]->options : NULL,
      '#size' => $this->getSetting('options_size'),
      '#placeholder' => $this->getSetting('placeholder')['options'],
      '#maxlength' => $this->getFieldSetting('options_max_length'),
    ];

    $element['startdate'] = [
      '#type' => 'date',
      '#title' => 'Start Date',
      '#default_value' => isset($items[$delta]->startdate) ? $items[$delta]->startdate : NULL,
      '#size' => $this->getSetting('startdate_size'),
      '#placeholder' => $this->getSetting('placeholder')['startdate'],
      '#maxlength' => $this->getFieldSetting('startdate_max_length'),
    ];

    return $element;
  }

}
