<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LoginForm.
 */
class LoginForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'login_form';
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
      $form['email'] = [
          '#type' => 'email',
          '#title' => t('Email: '),
      ];
      $form['submit'] = [
          '#type' => 'submit',
          '#value' => t('Login'),
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
