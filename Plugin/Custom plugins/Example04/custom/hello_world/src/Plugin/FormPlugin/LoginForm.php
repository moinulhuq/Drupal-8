<?php

/**
 * @file
 * Contains \Drupal\hello_world\Plugin\FormPlugin\LoginForm.
 */

namespace Drupal\hello_world\Plugin\FormPlugin;

use Drupal\hello_world\Plugin\FormPluginInterface;
use Drupal\hello_world\Plugin\FormPluginBase;

/**
 * Provides a login form.
 *
 * @FormPlugin(
 *   id = "login_form",
 *   label = @Translation("Login Form"),
 *   form = "Drupal\hello_world\Form\LoginForm",
 * )
 */
class LoginForm extends FormPluginBase implements FormPluginInterface {

    /**
    * Get a description of Login Form.
    *
    */
    public function description() {
        return 'Login Form';
    }

}
