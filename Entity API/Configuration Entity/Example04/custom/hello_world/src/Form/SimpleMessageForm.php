<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SimpleMessageForm.
 */
class SimpleMessageForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $simple_message = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $simple_message->label(),
      '#description' => $this->t("Label for the Simple message."),
      '#required' => TRUE,
    ];
      $form['message'] = [
          '#type' => 'textarea',
          '#title' => t('Message'),
          '#required' => TRUE,
          '#default_value' => $simple_message->message,
      ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $simple_message->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hello_world\Entity\SimpleMessage::load',
      ],
      '#disabled' => !$simple_message->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $simple_message = $this->entity;
    $status = $simple_message->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Simple message.', [
          '%label' => $simple_message->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Simple message.', [
          '%label' => $simple_message->label(),
        ]));
    }
    $form_state->setRedirectUrl($simple_message->toUrl('collection'));
  }

}
