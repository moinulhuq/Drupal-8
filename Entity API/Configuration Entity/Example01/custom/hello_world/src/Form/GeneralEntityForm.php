<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GeneralEntityForm.
 */
class GeneralEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $general_entity = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $general_entity->label(),
      '#description' => $this->t("Label for the General entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $general_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hello_world\Entity\GeneralEntity::load',
      ],
      '#disabled' => !$general_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $general_entity = $this->entity;

    $status = $general_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label General entity.', [
          '%label' => $general_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label General entity.', [
          '%label' => $general_entity->label(),
        ]));
    }

    $form_state->setRedirectUrl($general_entity->toUrl('collection'));

  }

}
