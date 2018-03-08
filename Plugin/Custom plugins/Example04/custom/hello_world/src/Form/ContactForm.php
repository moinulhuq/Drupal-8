<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ContactForm.
 */
class ContactForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      $form['name'] = [
          '#type' => 'textfield',
          '#title' => t('Name: '),
          '#placeholder' => t('Name...'),
          '#required' => true,
      ];
      $form['address'] = [
          '#type' => 'textarea',
          '#title' => t('Company Address: '),
          '#description' => t('Welcome message display to users when they login'),
          //'#default_value' => t('welcome message'),
      ];
      $form['email'] = [
          '#type' => 'email',
          '#title' => t('Email: '),
      ];
      $form['phone'] = [
          '#type' => 'tel',
          '#title' => t('Phone: '),
      ];
      $form['submit'] = [
          '#type' => 'submit',
          '#value' => t('Submit'),
      ];
      return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
