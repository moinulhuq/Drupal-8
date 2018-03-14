Step01: Create routes for the new entity.

hello_world.routing.yml
-----------------------
```yml
entity.general_entity.collection:
  path: '/admin/structure/general_entity'
  defaults:
    _entity_list: 'general_entity'
    _title: 'General Entity'
  requirements:
    _permission: 'administer site configuration'

entity.general_entity.add_form:
  path: '/admin/structure/general_entity/add'
  defaults:
    _entity_form: 'general_entity.add'
    _title: 'General Entity Add'
  requirements:
    _permission: 'administer site configuration'

entity.general_entity.edit_form:
  path: '/admin/structure/general_entity/{general_entity}/edit'
  defaults:
    _entity_form: 'general_entity.edit'
    _title: 'General Entity Edit'
  requirements:
    _permission: 'administer site configuration'

entity.general_entity.delete_form:
  path: '/admin/structure/general_entity/{general_entity}/delete'
  defaults:
    _entity_form: 'general_entity.delete'
    _title: 'General Entity Delete'
  requirements:
    _permission: 'administer site configuration'
```

Here "entity.general_entity.collection" is "_entity_list" others are like "entity.general_entity.add_form" is "_entity_form".

Step02: Add links into the main navigation.

hello_world.links.menu.yml
--------------------------
```yml
entity.general_entity.collection:
  title: 'General entity'
  route_name: entity.general_entity.collection
  description: 'List General entity (bundles)'
  parent: system.admin_structure
  weight: 99
```

hello_world.links.action.yml
-----------------------------
```yml
entity.general_entity.add_form:
  route_name: entity.general_entity.add_form
  title: 'Add General entity'
  appears_on:
    - entity.general_entity.collection
```

Step03: Create schema.

general_entity.schema.yml
-------------------------
```yml
hello_world.general_entity.*:
  type: config_entity
  label: 'General entity config'
  mapping:
    id:
      type: string
      label: 'ID'
    label:
      type: label
      label: 'Label'
    uuid:
      type: string
```

Configuration schema predefines two types of configuration files: "config_object" for global configuration files and "config_entity" for entities.

Step04: Define custom entity with Interface.

GeneralEntityInterface.php
--------------------------
```php
interface GeneralEntityInterface extends ConfigEntityInterface {

  // Add get/set methods for your configuration properties here.
}
```

GeneralEntity.php
--------------------------
```php
namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the General entity entity.
 *
 * @ConfigEntityType(
 *   id = "general_entity",
 *   label = @Translation("General entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\hello_world\GeneralEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\hello_world\Form\GeneralEntityForm",
 *       "edit" = "Drupal\hello_world\Form\GeneralEntityForm",
 *       "delete" = "Drupal\hello_world\Form\GeneralEntityDeleteForm"
 *     },
 *   },
 *   config_prefix = "general_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/general_entity/{general_entity}",
 *     "add-form" = "/admin/structure/general_entity/add",
 *     "edit-form" = "/admin/structure/general_entity/{general_entity}/edit",
 *     "delete-form" = "/admin/structure/general_entity/{general_entity}/delete",
 *     "collection" = "/admin/structure/general_entity"
 *   }
 * )
 */
class GeneralEntity extends ConfigEntityBase implements GeneralEntityInterface {

  /**
   * The General entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The General entity label.
   *
   * @var string
   */
  protected $label;

}
```

Using annotations, we are basically telling Drupal about our entity type.

Step05: Create forms and controllers/handlers for the required functionality.

GeneralEntityListBuilder.php
----------------------------
```php
class GeneralEntityListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('General entity');
    $header['id'] = $this->t('Machine name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
```

A class file responsible for building the overview page of our entities. buildHeader() method is responsible for creating the table header of our overview page whereas buildRow() will create the rows based on the number of entities and their values.

GeneralEntityForm.php
---------------------
```php
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $general_entity = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $general_entity->label(),
      '#description' => $this->t("Label for the General entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $general_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\hello_world\Entity\GeneralEntity::load',
      ],
      '#disabled' => !$general_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }
```

To enter the configuration of our entity.

GeneralEntityDeleteForm.php
----------------------------
```php
class GeneralEntityDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.general_entity.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    drupal_set_message(
      $this->t('content @type: deleted @label.',
        [
          '@type' => $this->entity->bundle(),
          '@label' => $this->entity->label(),
        ]
        )
    );

    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
```