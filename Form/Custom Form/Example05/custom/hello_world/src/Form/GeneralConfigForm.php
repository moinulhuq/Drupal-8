<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GeneralConfigForm.
 */
class GeneralConfigForm extends ConfigFormBase {

    /**
     * Error Message
     */
    public $fields = [
        'name'=>'Name is not valid',
        'gender'=>'Gender is not valid',
        'dob'=>'Date of Birth is not valid',
        'email'=>'Please enter valid email',
        'phone'=>'Please enter valid phone number',
        'termsncon'=>'Please accept Terms and Condition',
    ];

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

      return [
          'hello_world.generalconfig',
      ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {

      return 'general_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

      // Disable caching & HTML5 validation
      $form['#cache']['max-age'] = 0;
      $form['#attributes']['novalidate'] = 'novalidate';

      // Getting value from config file.
      $config = $this->config('hello_world.generalconfig');

      $form['name'] = [
          '#type' => 'textfield',
          '#title' => t('Name: '),
          '#placeholder' => t('Name...'),
          '#attributes' => ['autofocus' => 'autofocus', ],
          '#required' => false,
          '#default_value' => $config->get('name'),
          '#prefix' => '<div class="form-group">',
          '#suffix' => '<div class="input-error-name alert alert-danger"></div></div>'
      ];

      $form['email'] = [
          '#type' => 'email',
          '#title' => t('Email: '),
          '#default_value' => $config->get('email'),
          '#prefix' => '<div class="form-group">',
          '#suffix' => '<div class="input-error-email alert alert-danger"></div></div>'
      ];

      return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

      if (!$form_state->getValue('name') || empty($form_state->getValue('name'))) {
          $form_state->setErrorByName( 'name', t($this->fields['name']));
      }

      if (!$form_state->getValue('email') || !filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
          $form_state->setErrorByName('email', t($this->fields['email']));
      }

      if ($form_errors  = $form_state->getErrors()) {

          foreach ($form_errors as $key => $value) {
              $form[$key]['#prefix'] = '<div class="form-group">';
              $form[$key]['#suffix'] = '<div class="input-error-' . $key . ' alert alert-danger">' . $value . '</div></div>';
          }
      }

      parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $this->config('hello_world.generalconfig')
         ->set('name', $form_state->getValue('name'))
         ->set('email', $form_state->getValue('email'))
         ->save();

      parent::submitForm($form, $form_state);
  }

}
