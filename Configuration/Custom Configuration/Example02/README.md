Defining and using your own configuration in Drupal 8.

Each module, theme or profile can provide default configuration. Default values for configuration must be in its "config/install" or "config/optional" sub-directory and name would be "modulename.settings.yml". For more complex settings, you can separate your configuration into multiple files. 

```yml
config/install/hello_world.settings.yml

(or)

config/optional/hello_world.settings.yml

(or) for more complex configuration

config/install/
			image.settings.yml
			image.style.large.yml
			image.style.medium.yml
			image.style.thumbnail.yml
```

check your "core/modules/image/config/install"

You can make your module depend on the other module. In this case, put the dependent configuration in the con g/install directory along with the rest of your configuration.

You can provide the configuration in the con g/optional directory and avoid hav‐ ing a module dependency. When your module is installed, if the modules this configuration depend on are already installed, your configuration will be impor‐ ted into the site. Or, if those modules are installed later, your module’s con g/ optional directory will be scanned again for configuration whose dependencies have now been met, and the configuration will be imported then.

hello_world.settings.yml
------------------------

```yml
submit_button_label: 'Submit'
name_field_settings:
  field_label: 'Your name'
  field_size: 50
```

You can provide a configuration schema file under "config/schema/hello_world.schema.yml" which describes the data types of the configuration data items, as well as the labels they should have when configuration is being translated.

hello_world.schema.yml
----------------------

```yml
mymodule.settings:
  type: config_object
  label: 'My module settings'
  mapping:
    submit_button_label:
      type: label
      label: 'Label for submit button'
    name_field_settings:
      type: mapping
      label: 'Settings for name field'
      mapping:
        field_label:
          type: label
          label: 'Label for name field'
        field_size:
          type: integer
          label: 'Size of name field'
```