<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\user\UserInterface;

/**
 * Defines the Contact person entity.
 *
 * @ingroup hello_world
 *
 * @ContentEntityType(
 *   id = "contact_person",
 *   label = @Translation("Contact person"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hello_world\ContactPersonListBuilder",
 *     "views_data" = "Drupal\hello_world\Entity\ContactPersonViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\hello_world\Form\ContactPersonForm",
 *       "add" = "Drupal\hello_world\Form\ContactPersonForm",
 *       "edit" = "Drupal\hello_world\Form\ContactPersonForm",
 *       "delete" = "Drupal\hello_world\Form\ContactPersonDeleteForm",
 *     },
 *     "access" = "Drupal\hello_world\ContactPersonAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\hello_world\ContactPersonHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "contact_person",
 *   admin_permission = "administer contact person entities",
 *   entity_keys = {
 *     "id" = "id"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/contact_person/{contact_person}",
 *     "add-form" = "/admin/structure/contact_person/add",
 *     "edit-form" = "/admin/structure/contact_person/{contact_person}/edit",
 *     "delete-form" = "/admin/structure/contact_person/{contact_person}/delete",
 *     "collection" = "/admin/structure/contact_person",
 *   },
 *   field_ui_base_route = "contact_person.settings"
 * )
 */
class ContactPerson extends ContentEntityBase implements ContactPersonInterface {

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // for Unique primary key.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the inventory entity.'))
      ->setReadOnly(TRUE);

    // For Name
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Person Name'))
      ->setDescription(t('The name of the person'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    // For Image
    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setDescription(t('The image of the person'))
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
        'weight' => 1,
        'label' => 'hidden',
        'settings' => [
          'image_style' => 'thumbnail',
        ],
      ])
      ->setDisplayOptions('form', array(
        'label' => 'hidden',
        'type' => 'image_image',
        'weight' => 1,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Gender
    $fields['gender'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Gender'))
      ->setDescription(t('The gender of the person'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setReadOnly(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSettings(array(
        'allowed_values' => [
          'male' => 'Male',
          'female' => 'Female',
        ],
      ))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 2,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Email
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDescription(t('The email of the person'))
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
        'weight' => 3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'email_default',
        'weight' => 3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->addConstraint('ProtectedUserField');

    // For Phone
    $fields['telephone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone'))
      ->setDescription(t('The phone number of that person'))
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
        'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'telephone_default',
        'weight' => 4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // For Address
    $fields['address'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Address'))
      ->setDescription(t('The address of the person'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getImage(){

    //$file_url = File::load($this->get('image')->target_id)->getFileUri(); // public://2018-03/moin.jpg
    // (Or)
    //$file_url = $this->get('image')->entity->url(); // http://localhost:8888/uniservice/sites/default/files/2018-03/moin.jpg
    // (Or)

    $file_url = $this->get('image')->entity->uri->value; // public://2018-03/moin.jpg

    return t("<img src='".ImageStyle::load('medium')->buildUrl($file_url)."'/>");

  }

  /**
   * {@inheritdoc}
   */
  public function getGender(){
    return $this->get('gender')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getEmail(){
    return $this->get('email')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getTelephone(){
    return $this->get('telephone')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getAddress(){
    return $this->get('address')->value;
  }

}
