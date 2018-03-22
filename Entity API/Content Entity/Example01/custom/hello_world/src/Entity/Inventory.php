<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Inventory entity.
 *
 * @ingroup hello_world
 *
 * @ContentEntityType(
 *   id = "inventory",
 *   label = @Translation("Inventory"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hello_world\InventoryListBuilder",
 *     "views_data" = "Drupal\hello_world\Entity\InventoryViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\hello_world\Form\InventoryForm",
 *       "add" = "Drupal\hello_world\Form\InventoryForm",
 *       "edit" = "Drupal\hello_world\Form\InventoryForm",
 *       "delete" = "Drupal\hello_world\Form\InventoryDeleteForm",
 *     },
 *     "access" = "Drupal\hello_world\InventoryAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\hello_world\InventoryHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "inventory",
 *   admin_permission = "administer inventory entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/inventory/{inventory}",
 *     "add-form" = "/admin/structure/inventory/add",
 *     "edit-form" = "/admin/structure/inventory/{inventory}/edit",
 *     "delete-form" = "/admin/structure/inventory/{inventory}/delete",
 *     "collection" = "/admin/structure/inventory",
 *   },
 *   field_ui_base_route = "inventory.settings"
 * )
 */
class Inventory extends ContentEntityBase implements InventoryInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

//  check https://www.drupal.org/docs/8/api/entity-api/fieldtypes-fieldwidgets-and-fieldformatters
//  check https://www.drupal.org/docs/8/api/entity-api/defining-and-using-content-entity-field-definitions
//  check https://api.drupal.org/api/drupal/core!lib!Drupal!Core!Field!Annotation!FieldWidget.php/class/annotations/FieldWidget/8.5.x

    // For Item Tracking
    $fields['track'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Item Track'))
      ->setDescription(t('Track inventory.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'boolean',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // For Item Name
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Item Name'))
      ->setDescription(t('The name of the Inventory entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 1,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    // For Item Image
    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Item Image'))
      ->setDescription(t('Image field'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setSettings([
        'file_directory' => 'IMAGE_FOLDER',
        'alt_field_required' => FALSE,
        'file_extensions' => 'png jpg jpeg',
      ])
      ->setDisplayOptions('view', [
        'type' => 'image',
        'weight' => 2,
        'label' => 'hidden',
        'settings' => [
          'image_style' => 'thumbnail',
        ],
      ])
      ->setDisplayOptions('form', array(
        'label' => 'hidden',
        'type' => 'image_image',
        'weight' => 2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Item Content
    $fields['content'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Item Content'))
      ->setDescription(t('A Content of the inventory.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'weight' => 3,
        'settings' => [
          'rows' => 12,
        ],
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // For Item Category
    $fields['category'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Item Category'))
      ->setDescription(t('The inventory category.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings(array(
        'allowed_values' => [
          'wood' => 'wood',
          'iron' => 'iron',
        ],
      ))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Item Semi Category
    $fields['semicategory'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Item Semi Category'))
      ->setDescription(t('The inventory semi category.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings(array(
        'allowed_values' => [
          'pinewood' => 'pine wood',
          'custiron' => 'cust iron',
        ],
      ))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_buttons',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Item Size
    $fields['size'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Item Size'))
      ->setDescription(t('The size of the content.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSetting('unsigned', TRUE)
      ->setSetting('size', 'big')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'number_integer',
        'weight' => 6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 6,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // For Item URI
    $fields['uri'] = BaseFieldDefinition::create('uri')
      ->setLabel(t('Item URI'))
      ->setDescription(t('The URI to access the file'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSetting('max_length', 255)
      ->setSetting('case_sensitive', TRUE)
      ->addConstraint('FileUriUnique')
      ->setDisplayOptions('form', [
        'type' => 'uri',
        'weight' => 7,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 7,
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Item Description
    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Item Description'))
      ->setDescription(t('A description of the inventory.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'text_default',
        'weight' => 8,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textfield',
        'weight' => 8,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // For Item Brief
    $fields['brief'] = BaseFieldDefinition::create('text')
      ->setLabel(t('Item Brief'))
      ->setDescription(t('A brief description of inventory.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'text_default',
        'weight' => 9,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textfield',
        'weight' => 9,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // For Item Supplier Email
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Item Supplier Email'))
      ->setDescription(t('The Email Address.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => 10,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'email_default',
        'weight' => 10,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->addConstraint('ProtectedUserField');

    // For Item Supplier Phone
    $fields['telephone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Item Supplier Phone'))
      ->setDescription(t('The Telephone Number.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => 11,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'telephone_default',
        'weight' => 11,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    //For Publishing status
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Inventory is published.'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'checkbox',
        'weight' => 12,
      ])
      ->setDisplayConfigurable('view', TRUE);

    //For Authored by
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Inventory entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 13,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 13,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    //For date Created
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Date Created'))
      ->setDescription(t('The time that the entity was created.'));

    //For date Changed
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Date Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
