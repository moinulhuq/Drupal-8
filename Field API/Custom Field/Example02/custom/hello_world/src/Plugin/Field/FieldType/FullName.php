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
 * Plugin implementation of the 'full_name' field type.
 *
 * @FieldType(
 *   id = "full_name",
 *   label = @Translation("Full name"),
 *   description = @Translation("My Field Type"),
 *   category = @Translation("General"),
 *   default_widget = "full_name_widget_type",
 *   default_formatter = "full_name_formatter_type"
 * )
 */
class FullName extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'fname_max_length' => 255,
      'mname_max_length' => 255,
      'lname_max_length' => 255,
      'is_ascii' => FALSE,
      'case_sensitive' => FALSE,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    // Prevent early t() calls by using the TranslatableMarkup.

    $properties['fname'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['mname'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['lname'] = DataDefinition::create('string')
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

        'fname' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],

        'mname' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],

        'lname' => [
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

    if ($max_length = $this->getSetting('max_length')) {
      $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
      $constraints[] = $constraint_manager->create('ComplexData', [

        'fname' => [
          'Length' => [
            'max' => $max_length,
            'maxMessage' => t('%name: may not be longer than @max characters.', [
              '%name' => $this->getFieldDefinition()->getLabel(),
              '@max' => $max_length
            ]),
          ],
        ],

        'mname' => [
          'Length' => [
            'max' => $max_length,
            'maxMessage' => t('%name: may not be longer than @max characters.', [
              '%name' => $this->getFieldDefinition()->getLabel(),
              '@max' => $max_length
            ]),
          ],
        ],

        'lname' => [
          'Length' => [
            'max' => $max_length,
            'maxMessage' => t('%name: may not be longer than @max characters.', [
              '%name' => $this->getFieldDefinition()->getLabel(),
              '@max' => $max_length
            ]),
          ],
        ],

      ]);
    }

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['fname'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['mname'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['lname'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {

    $elements = [];

    $elements['fname_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length First Name'),
      '#default_value' => $this->getSetting('fname_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['mname_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Middle Name'),
      '#default_value' => $this->getSetting('mname_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['lname_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Last Name'),
      '#default_value' => $this->getSetting('lname_max_length'),
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
    $fname = $this->get('fname')->getValue();
    $mname = $this->get('mname')->getValue();
    $lname = $this->get('lname')->getValue();
    return $fname === NULL || $fname === '' || $mname === NULL || $mname ==='' || $lname === NULL || $lname ==='';
  }

}
