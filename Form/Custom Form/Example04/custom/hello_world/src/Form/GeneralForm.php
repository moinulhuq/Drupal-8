<?php
namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GeneralForm.
 */
class GeneralForm extends FormBase {

    /**
     * Error Message
     */
    public $fields = [
        'name'=>'Name is not valid',
        'gender'=>'Gender is not valid',
    ];

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'general_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        /*-------For more https://api.drupal.org/api/drupal/elements/8.2.x--------*/

        // This will generate an anchor scroll to the form when submitting
        $form['#action'] = '#general_form';

        // Disable caching & HTML5 validation
        $form['#cache']['max-age'] = 0;
        $form['#attributes']['novalidate'] = 'novalidate';

        /*--------For more https://api.drupal.org/api/drupal/core!core.api.php/group/ajax/8.2.x-------*/

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => t('Name: '),
            '#placeholder' => t('Name...'),
            '#attributes' => ['autofocus' => 'autofocus', ],
            '#required' => false,
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validateNameAjax', 'input-error-name'),
            '#suffix' => '</div>'
        ];
        $form['input-error-name'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'input-error-name'],
        ];
        $form['gender'] = [
            '#type' => 'select',
            '#title' => ('Gender'),
            '#options' => [
                'neutral' => t('Please Select...'),
                'Female' => t('Female: '),
                'male' => t('Male'),
            ],
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validateGenderAjax', 'input-error-gender'),
            '#suffix' => '</div>'
        ];
        $form['input-error-gender'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'input-error-gender'],
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => t('Submit'),
        ];

        return $form;
    }

    /**
     * Return Ajax Block
     */
    public function AjaxBlock( $validationFunctionName, $wrapper ){
         return $ajax = [
            'callback' => [ $this , $validationFunctionName ],
            'wrapper' => $wrapper,
            'effect' => 'fade',
            'event' => 'change',
            'disable-refocus'=> true,
            'progress' => array(
                'type' => 'throbber',
                'message' => t('Verifying...'),
            ),
        ];
    }

    /**
     * Ajax callback to validate the Name.
     */
    function validBlock(array &$form, FormStateInterface $form_state, $fields){
        $form['input-error-'.$fields]['#markup'] = '';
    }

    /**
     * Ajax callback to validate the Name.
     */
    function errorBlock(array &$form, FormStateInterface $form_state, $fields){
        $form['input-error-'.$fields]['#markup'] = $this->fields[$fields];
    }

    /**
     * Ajax callback to validate the Name.
     */
    function validateNameAjax(array &$form, FormStateInterface $form_state) {
        $this->validBlock($form, $form_state, 'name');
        if (!$form_state->getValue('name') || empty($form_state->getValue('name'))) {
            $this->errorBlock($form, $form_state, 'name');
        }
        return $form['input-error-name'];
    }

    /**
     * Ajax callback to validate the Gender.
     */
    function validateGenderAjax(array &$form, FormStateInterface $form_state) {
        $this->validBlock($form, $form_state, 'name');
        if (!$form_state->getValue('gender') || $form_state->getValue('gender')=="neutral") {
            $this->errorBlock($form, $form_state, 'gender');
        }
        return $form['input-error-gender'];
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if (!$form_state->getValue('name') || empty($form_state->getValue('name'))) {
            $form_state->setErrorByName( 'name', t($this->fields['name']));
        }
        if (!$form_state->getValue('gender') || $form_state->getValue('gender')=="neutral") {
            $form_state->setErrorByName('gender', t($this->fields['gender']));
        }
        if ($form_errors  = $form_state->getErrors()) {
            {
                foreach ($form_errors as $key => $value) {
                    $this->errorBlock($form, $form_state, $key);
                }
            }
        }
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