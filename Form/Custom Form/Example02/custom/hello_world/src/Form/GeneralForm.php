<?php
namespace Drupal\hello_world\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Class GeneralForm.
 */
class GeneralForm extends FormBase {
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

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => t('Name: '),
            '#placeholder' => t('Name...'),
            '#required' => false,
        ];
        $form['gender'] = [
            '#type' => 'select',
            '#title' => ('Gender'),
            '#options' => [
                'neutral' => t('Please Select...'),
                'Female' => t('Female: '),
                'male' => t('Male'),
            ],
        ];
        $form['dob'] = [
            '#type' => 'date',
            '#title' => t('Date of birth: '),
            '#date_date_format' => 'Y-m-d',
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
        $form['website'] = [
            '#type' => 'url',
            '#title' => t('Website: '),
        ];
        $form['agerange'] = [
            '#type' => 'range',
            '#title' => t('Age range: '),
            '#min' => 0,
            '#max' => 100,
            '#step' => 1,
        ];
        $form['ageconfirmation'] = [
            '#type' => 'radios',
            '#title' => t('Are you above 18 years old?'),
            '#default_value' => 'No',
            '#options' => [
                'Yes' =>t('Yes'),
                'No' =>t('No')
            ],
        ];
        $form['luckynumber'] = [
            '#type' => 'number',
            '#title' => t('Lucky number: '),
            // The increment or decrement amount
            '#step' => 1,
            // Miminum allowed value
            '#min' => 0,
            // Maxmimum allowed value
            '#max' => 100,
        ];
        $form['favourite'] = [
            '#type' => 'search',
            '#title' => t('Favourite web: '),
            '#autocomplete_route_name' => FALSE,
        ];
        $form['termsncon'] = [
            '#type' => 'checkbox',
            '#default_value' => TRUE,
            '#title' => t('I accept the Terms and conditions.'),
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
        if (!$form_state->getValue('name') || empty($form_state->getValue('name'))) {
            $form_state->setErrorByName('name', $this->t('Name can not be empty'));
        }
        if (!$form_state->getValue('gender') || $form_state->getValue('gender')=="neutral") {
            $form_state->setErrorByName('gender', $this->t('Gender can not be empty'));
        }
        if (!$form_state->getValue('dob') || empty($form_state->getValue('dob'))) {
            $form_state->setErrorByName('dob', $this->t('DOB can not be empty'));
        }
        if (!$form_state->getValue('address') || empty($form_state->getValue('address'))) {
            $form_state->setErrorByName('address', $this->t('Address can not be empty'));
        }
        if (!$form_state->getValue('email') || !filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
            $form_state->setErrorByName('email', $this->t('Email is not valid'));
        }
        if (!$form_state->getValue('phone') || empty($form_state->getValue('phone'))) {
            $form_state->setErrorByName('phone', $this->t('Phone number can not be empty'));
        }
        if (!$form_state->getValue('website') || !filter_var($form_state->getValue('website'), FILTER_VALIDATE_URL)) {
            $form_state->setErrorByName('website', $this->t('Website link is not valid'));
        }
        if (!$form_state->getValue('luckynumber') || !filter_var($form_state->getValue('luckynumber'), FILTER_VALIDATE_INT)) {
            $form_state->setErrorByName('luckynumber', $this->t('Number is not valid integer'));
        }
        if (!$form_state->getValue('favourite') || !filter_var($form_state->getValue('favourite'), FILTER_VALIDATE_URL)) {
            $form_state->setErrorByName('favourite', $this->t('Favourite website link is not valid'));
        }
        if (!$form_state->getValue('termsncon') || empty($form_state->getValue('termsncon'))) {
            $form_state->setErrorByName('termsncon', $this->t('termsncon'));
        }

        // If validation errors, add inline errors
        if ($form_errors  = $form_state->getErrors()) {
            {
                foreach ($form_errors as $key => $value) {
                    $form[$key]['#prefix'] = '<div class="form-group">';
                    $form[$key]['#suffix'] = '<div class="input-error alert alert-danger">' . $value . '</div></div>';
                }
            }
        }

        //parent::validateForm($form, $form_state);
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