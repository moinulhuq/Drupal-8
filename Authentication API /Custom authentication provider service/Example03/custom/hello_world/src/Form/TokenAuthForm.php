<?php

namespace Drupal\hello_world\Form;

use Drupal\Component\Utility\Crypt;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TokenAuthForm.
 */
class TokenAuthForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $token_auth = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $token_auth->label(),
      '#description' => $this->t("Label for the token."),
      '#required' => TRUE,
    ];

    $form['token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Token'),
      '#maxlength' => 255,
      '#disabled' => 'disabled',
      '#default_value' => Crypt::randomBytesBase64(),
      '#description' => $this->t("Auto generated token."),
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Active'),
      '#maxlength' => 255,
      '#description' => $this->t("Wanna active it?"),
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $token_auth->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hello_world\Entity\TokenAuth::load',
      ],
      '#disabled' => !$token_auth->isNew(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $token_auth = $this->entity;
    $status = $token_auth->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Token auth.', [
          '%label' => $token_auth->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Token auth.', [
          '%label' => $token_auth->label(),
        ]));
    }
    $form_state->setRedirectUrl($token_auth->toUrl('collection'));
  }

}
