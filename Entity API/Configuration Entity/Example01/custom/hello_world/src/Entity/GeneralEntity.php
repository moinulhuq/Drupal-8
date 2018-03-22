<?php

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

// Check https://wunder.io/blog/configuration-entities-in-drupal-8/2014-07-14

}
