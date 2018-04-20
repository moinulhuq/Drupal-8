<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ipList.
 */
class ipList extends ConfigFormBase {

  /**
   * Error Message
   */
  public $fields = [
    'ips'=>'IP is not valid',
  ];

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'hello_world.iplist',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ip_list';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hello_world.iplist');

    $form['ips'] = [
      '#type' => 'textarea',
      '#title' => t('IP: '),
      '#placeholder' => t('IPs...'),
      '#attributes' => ['autofocus' => 'autofocus', ],
      '#default_value' => $config->get('ips'),
      '#prefix' => '<div class="form-group">',
      '#suffix' => '<div class="input-error-name alert alert-danger"></div></div>'
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if (!$form_state->getValue('ips') || empty($form_state->getValue('ips'))) {
      $form_state->setErrorByName( 'ips', t($this->fields['ips']));
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

    $this->config('hello_world.iplist')
      ->set('ips', $form_state->getValue('ips'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
