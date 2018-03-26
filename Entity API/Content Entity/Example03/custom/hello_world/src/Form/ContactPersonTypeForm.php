<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ContactPersonTypeForm.
 */
class ContactPersonTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $contact_person_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $contact_person_type->label(),
      '#description' => $this->t("Label for the Contact person type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $contact_person_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hello_world\Entity\ContactPersonType::load',
      ],
      '#disabled' => !$contact_person_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $contact_person_type = $this->entity;
    $status = $contact_person_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Contact person type.', [
          '%label' => $contact_person_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Contact person type.', [
          '%label' => $contact_person_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($contact_person_type->toUrl('collection'));
  }

}
