Create custom forms ('login' and 'contact') and call it through controller usign plugin.

Create plugin 'LoginForm'

```php
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
```

Create 'FormPluginBase' which implements 'ContainerFactoryPluginInterface'

```php
abstract class FormPluginBase extends PluginBase implements FormPluginInterface, ContainerFactoryPluginInterface {

    /**
     * The form builder.
     *
     * @var \Drupal\Core\Form\FormBuilder.
     */
    protected $formBuilder;

    /**
     * Class constructor.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, $form_builder) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->formBuilder = $form_builder;
    }
    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('form_builder')
        );
    }

    public function getId() {
        return $this->pluginDefinition['id'];
    }

    public function getLabel(){
        return $this->pluginDefinition['label'];
    }

    public function getForm(){
        return $this->formBuilder->getForm($this->pluginDefinition['form']);
    }

}
```

create forms using drupal console

```
hello_world\
	form\
		LoginForm.php
		ContactForm.php
```

call this form from the controller

```php
class GeneralController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return form.
   */
  public function hello() {

    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('login_form');
    $build['#title'] = $plugin->description();
    $build['form'] =  $plugin->getForm();

//    $plugin  =  \Drupal::service('plugin.manager.form_plugin')->createInstance('contact_form');
//    $build['#title'] = $plugin->description();
//    $build['form'] =  $plugin->getForm();

    return $build;
  }

}
```

Tips:

To get custom form

```php
\Drupal::formBuilder()->getForm(NAMESPACE\OF\FORM);
```