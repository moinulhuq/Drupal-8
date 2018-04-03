<?php

namespace Drupal\hello_world\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'address' field type.
 *
 * @FieldType(
 *   id = "address",
 *   label = @Translation("Address"),
 *   description = @Translation("My Field Type"),
 *   category = @Translation("Custom"),
 *   default_widget = "address_widget",
 *   default_formatter = "address_formatter"
 * )
 */

class Address extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
        'address_one_max_length' => 255,
        'address_two_max_length' => 255,
        'city_max_length' => 255,
        'state_max_length' => 255,
        'postal_code_max_length' => 255,
        'country_max_length' => 255,
        'is_ascii' => FALSE,
        'case_sensitive' => FALSE,
      ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.

    $properties['address_one'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['address_two'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['city'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['state'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['postal_code'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['country'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'address_one' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'address_two' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'city' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'state' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'postal_code' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'country' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {

    $constraints = parent::getConstraints();

    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();

    $constraints[] = $constraint_manager->create('ComplexData', [
      'address_one' => [
        'Length' => [
          'max' => $this->getSetting('address_one_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('address_one_max_length')
          ]),
        ],
      ],
      'address_two' => [
        'Length' => [
          'max' => $this->getSetting('address_two_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('address_two_max_length')
          ]),
        ],
      ],
      'city' => [
        'Length' => [
          'max' => $this->getSetting('city_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('city_max_length')
          ]),
        ],
      ],
      'state' => [
        'Length' => [
          'max' => $this->getSetting('state_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('state_max_length')
          ]),
        ],
      ],
      'postal_code' => [
        'Length' => [
          'max' => $this->getSetting('postal_code_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('postal_code_max_length')
          ]),
        ],
      ],
      'country' => [
        'Length' => [
          'max' => $this->getSetting('country_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('country_max_length')
          ]),
        ],
      ],
    ]);

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['address_one'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['address_two'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['city'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['state'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['postal_code'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['country'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['address_one_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Address One'),
      '#default_value' => $this->getSetting('address_one_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['address_two_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Address Two'),
      '#default_value' => $this->getSetting('address_two_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['city_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length City'),
      '#default_value' => $this->getSetting('city_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['state_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length State'),
      '#default_value' => $this->getSetting('state_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['postal_code_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Postal Code'),
      '#default_value' => $this->getSetting('postal_code_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['country_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Country'),
      '#default_value' => $this->getSetting('country_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $address_one = $this->get('address_one')->getValue();
    $address_two = $this->get('address_two')->getValue();
    $state = $this->get('state')->getValue();
    $postal_code = $this->get('postal_code')->getValue();
    return $address_one === NULL || $address_one === '' || $address_two === NULL || $address_two === '' ||  $state === NULL || $state === '' || $postal_code === NULL || $postal_code === '';
  }

}
