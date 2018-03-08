<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\FormPlugin\ContactForm.
 */

namespace Drupal\hello_world\Plugin\FormPlugin;

use Drupal\hello_world\Plugin\FormPluginInterface;
use Drupal\hello_world\Plugin\FormPluginBase;

/**
 * Provides a contact form.
 *
 * @FormPlugin(
 *   id = "contact_form",
 *   label = @Translation("Contact Form"),
 *   form = "Drupal\hello_world\Form\ContactForm",
 * )
 */
class ContactForm extends FormPluginBase implements FormPluginInterface {

    /**
    * Get a description of the Contact Form.
    *
    */
    public function description() {
        return 'Contact Form';
    }

}
