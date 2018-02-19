<?php
namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\CssCommand;

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
        'dob'=>'Date of Birth is not valid',
        'email'=>'Please enter valid email',
        'phone'=>'Please enter valid phone number',
        'termsncon'=>'Please accept Terms and Condition',
    ];

    /**
     * Error Color
     */
    public $color = [
        'errorColor' => ['border' => '2px solid red'],
        'validColor' =>  ['border' => '2px solid green'],
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
            '#ajax' => $this->AjaxBlock('validateNameAjax'),
            '#suffix' => '<div class="input-error-name alert alert-danger"></div></div>'
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
            '#ajax' => $this->AjaxBlock('validateGenderAjax'),
            '#suffix' => '<div class="input-error-gender alert alert-danger"></div></div>'
        ];
        $form['dob'] = [
            '#type' => 'date',
            '#title' => t('Date of birth: '),
            '#date_date_format' => 'Y-m-d',
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validateDOBAjax'),
            '#suffix' => '<div class="input-error-dob alert alert-danger"></div></div>'
        ];
        $form['email'] = [
            '#type' => 'email',
            '#title' => t('Email: '),
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validateEmailAjax'),
            '#suffix' => '<div class="input-error-email alert alert-danger"></div></div>'
        ];
        $form['phone'] = [
            '#type' => 'tel',
            '#title' => t('Phone: '),
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validatePhoneAjax'),
            '#suffix' => '<div class="input-error-phone alert alert-danger"></div></div>'
        ];
        $form['termsncon'] = [
            '#type' => 'checkbox',
            //'#default_value' => TRUE,
            '#title' => t('I accept the Terms and conditions.'),
            '#prefix' => '<div class="form-group">',
            '#ajax' => $this->AjaxBlock('validateTermnConAjax'),
            '#suffix' => '<div class="input-error-termsncon alert alert-danger"></div></div>'
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
    public function AjaxBlock( $validationFunctionName ){
         return $ajax = [
            //'callback' => '::validateFormAjax',
            'callback' => [ $this , $validationFunctionName ],
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
    function errorBlock(array &$form, FormStateInterface $form_state, AjaxResponse $response, $fields){
        $response->addCommand(new CssCommand('#edit-'.$form_state->getTriggeringElement()['#name'], $this->color['errorColor']));
        $response->addCommand(new HtmlCommand('.input-error-'.$form_state->getTriggeringElement()['#name'], t($fields)));
        return $response;
    }

    /**
     * Ajax callback to validate the Name.
     */
    function validBlock(array &$form, FormStateInterface $form_state, AjaxResponse $response){
        $response->addCommand(new CssCommand('#edit-' . $form_state->getTriggeringElement()['#name'], $this->color['validColor']));
        $response->addCommand(new HtmlCommand('.input-error-' . $form_state->getTriggeringElement()['#name'], ''));
        return $response;
    }

    /**
     * Ajax callback to validate the Name.
     */
    function validateNameAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('name') || empty($form_state->getValue('name')))
            $this->errorBlock($form, $form_state, $response, $this->fields['name']);

        return $response;
    }

    /**
     * Ajax callback to validate the Gender.
     */
    function validateGenderAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('gender') || $form_state->getValue('gender')=="neutral")
            $this->errorBlock($form, $form_state, $response, $this->fields['gender']);

        return $response;
    }

    /**
     * Ajax callback to validate the DOB.
     */
    function validateDOBAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('dob') || empty($form_state->getValue('dob')))
            $this->errorBlock($form, $form_state, $response, $this->fields['dob']);

        return $response;
    }

    /**
     * Ajax callback to validate the email.
     */
    function validateEmailAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('email') || !filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL))
            $this->errorBlock($form, $form_state, $response, $this->fields['email']);

        return $response;
    }

    /**
     * Ajax callback to validate the phone.
     */
    function validatePhoneAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('phone') || empty($form_state->getValue('phone')))
            $this->errorBlock($form, $form_state, $response, $this->fields['phone']);

        return $response;
    }

    /**
     * Ajax callback to validate the Terms and Condition.
     */
    function validateTermnConAjax(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
        $this->validBlock($form, $form_state, $response);
        if (!$form_state->getValue('termsncon') || empty($form_state->getValue('termsncon')))
            $this->errorBlock($form, $form_state, $response, $this->fields['termsncon']);

        return $response;
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
        if (!$form_state->getValue('dob') || empty($form_state->getValue('dob'))) {
            $form_state->setErrorByName('dob', t($this->fields['dob']));
        }
        if (!$form_state->getValue('email') || !filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
            $form_state->setErrorByName('email', t($this->fields['email']));
        }
        if (!$form_state->getValue('phone') || empty($form_state->getValue('phone'))) {
            $form_state->setErrorByName('phone', t($this->fields['phone']));
        }
        if (!$form_state->getValue('termsncon') || empty($form_state->getValue('termsncon'))) {
            $form_state->setErrorByName('termsncon', t($this->fields['termsncon']));
        }
            if ($form_errors  = $form_state->getErrors()) {
            {
                foreach ($form_errors as $key => $value) {
                    $form[$key]['#prefix'] = '<div class="form-group">';
                    $form[$key]['#suffix'] = '<div class="input-error-'.$key.' alert alert-danger">' . $value . '</div></div>';
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