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
 * Plugin implementation of the 'test' field type.
 *
 * @FieldType(
 *   id = "test",
 *   label = @Translation("Test"),
 *   description = @Translation("My Field Type"),
 *   default_widget = "test_widget",
 *   default_formatter = "test_formatter"
 * )
 */
class Test extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
        'name_max_length' => 255,
        'score_max_length' => 255,
        'cash_max_length' => 255,
        'male_max_length' => 255,
        'link_max_length' => 255,
        'email_max_length' => 255,
        'options_max_length' => 255,
        'startdate_max_length' => 20,
        'is_ascii' => FALSE,
        'case_sensitive' => FALSE,
      ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.

    $properties['name'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Name'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['score'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('score'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['cash'] = DataDefinition::create('float')
      ->setLabel(new TranslatableMarkup('Cash'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['male'] = DataDefinition::create('boolean')
      ->setLabel(new TranslatableMarkup('Male'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['link'] = DataDefinition::create('uri')
      ->setLabel(new TranslatableMarkup('URI value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['email'] = DataDefinition::create('email')
      ->setLabel(new TranslatableMarkup('Email'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    /* The "any" data type does not implement a list or complex data interface,
        nor is it mappable to any primitive type. Thus,
        it may contain any PHP data for which no further metadata is available.*/

    $properties['options'] = DataDefinition::create('any')
      ->setLabel(new TranslatableMarkup('Options'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['startdate'] = DataDefinition::create('datetime_iso8601')
      ->setLabel(new TranslatableMarkup('Start date'))
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
        'name' => [
          'description' => 'Name',
          'not null' => TRUE,
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('name_max_length'),
        ],
        'score' => [
          'description' => 'Socre',
          'not null' => TRUE,
          'type' => 'int',
          'length' => (int) $field_definition->getSetting('score_max_length'),
        ],
        'cash' => [
          'description' => 'Cash',
          'not null' => TRUE,
          'type' => 'float',
          'length' => (int) $field_definition->getSetting('cash_max_length'),
        ],
        'male' => [
          'description' => 'Male',
          'not null' => TRUE,
          'type' =>'int',
          'size' => 'tiny',
        ],
        'link' => [
          'description' => 'Link',
          'not null' => TRUE,
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('link_max_length'),
        ],
        'email' => [
          'description' => 'Email',
          'not null' => TRUE,
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('email_max_length'),
        ],
        'options' => [
          'description' => 'Options',
          'not null' => TRUE,
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('options_max_length'),
        ],
        'startdate' => [
          'description' => 'Date only',
          'not null' => TRUE,
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('startdate_max_length'),
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
      'name' => [
        'Length' => [
          'max' => $this->getSetting('name_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'score' => [
        'Length' => [
          'max' => $this->getSetting('score_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'cash' => [
        'Length' => [
          'max' => $this->getSetting('cash_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'male' => [
        'Length' => [
          'max' => $this->getSetting('male_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'link' => [
        'Length' => [
          'max' => $this->getSetting('link_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'email' => [
        'Length' => [
          'max' => $this->getSetting('email_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'options' => [
        'Length' => [
          'max' => $this->getSetting('options_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
          ]),
        ],
      ],
      'startdate' => [
        'Length' => [
          'max' => $this->getSetting('startdate_max_length'),
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@max' => $this->getSetting('startdate_max_length')
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
    $values['name'] = $random->word(mt_rand(1, $field_definition->getSetting('name_max_length')));
    $values['score'] = $random->word(mt_rand(1, $field_definition->getSetting('score_max_length')));
    $values['cash'] = $random->word(mt_rand(1, $field_definition->getSetting('cash_max_length')));
    $values['male'] = $random->word(mt_rand(1, $field_definition->getSetting('male_max_length')));
    $values['link'] = $random->word(mt_rand(1, $field_definition->getSetting('link_max_length')));
    $values['email'] = $random->word(mt_rand(1, $field_definition->getSetting('email_max_length')));
    $values['options'] = $random->word(mt_rand(1, $field_definition->getSetting('options_max_length')));
    $values['startdate'] = $random->word(mt_rand(1, $field_definition->getSetting('startdate_max_length')));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['name_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Name'),
      '#default_value' => $this->getSetting('name_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['score_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length score'),
      '#default_value' => $this->getSetting('score_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['cash_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length cash'),
      '#default_value' => $this->getSetting('score_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['male_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length male'),
      '#default_value' => $this->getSetting('male_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['link_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length link'),
      '#default_value' => $this->getSetting('link_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['email_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length email'),
      '#default_value' => $this->getSetting('email_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['options_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length options'),
      '#default_value' => $this->getSetting('options_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['startdate_max_length'] = [
      '#type' => 'number',
      '#title' => t('Max length Name'),
      '#default_value' => $this->getSetting('startdate_max_length'),
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

    $name = $this->get('name')->getValue();
    $score = $this->get('score')->getValue();
    $cash = $this->get('cash')->getValue();
    $male = $this->get('male')->getValue();
    $link = $this->get('link')->getValue();
    $email = $this->get('email')->getValue();
    $options = $this->get('options')->getValue();
    $startdate = $this->get('startdate')->getValue();

    return
      $name === NULL || $name === '' ||
      $score === NULL || $score === '' ||
      $cash === NULL || $cash === '' ||
      $male === NULL || $male === ''||
      $link === NULL || $link === ''||
      $email === NULL || $email === ''||
      $options === NULL || $options === '' ||
      $startdate === NULL || $startdate === '' ;
  }

}
