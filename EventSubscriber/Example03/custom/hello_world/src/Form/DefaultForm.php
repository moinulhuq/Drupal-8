<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\hello_world\Event\GeneralEvent;

/**
 * Class DefaultForm.
 */
class DefaultForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
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

      // Load dispatcher object through services.
      $dispatcher = \Drupal::service('event_dispatcher');

      // creating our event class object.
      $event = new GeneralEvent("Moin");

      // Dispatching the event through the ‘dispatch’  method,
      // Passing event name and event object ‘$event’ as parameters.
      $dispatcher->dispatch('general.event', $event);

  }

}
