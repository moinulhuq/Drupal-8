<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Contact person type entity.
 *
 * @ConfigEntityType(
 *   id = "contact_person_type",
 *   label = @Translation("Contact person type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hello_world\ContactPersonTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\hello_world\Form\ContactPersonTypeForm",
 *       "edit" = "Drupal\hello_world\Form\ContactPersonTypeForm",
 *       "delete" = "Drupal\hello_world\Form\ContactPersonTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\hello_world\ContactPersonTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "contact_person_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "contact_person",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/contact_person_type/{contact_person_type}",
 *     "add-form" = "/admin/structure/contact_person_type/add",
 *     "edit-form" = "/admin/structure/contact_person_type/{contact_person_type}/edit",
 *     "delete-form" = "/admin/structure/contact_person_type/{contact_person_type}/delete",
 *     "collection" = "/admin/structure/contact_person_type"
 *   }
 * )
 */
class ContactPersonType extends ConfigEntityBundleBase implements ContactPersonTypeInterface {

  /**
   * The Contact person type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Contact person type label.
   *
   * @var string
   */
  protected $label;

}
