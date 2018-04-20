<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Token auth entity.
 *
 * @ConfigEntityType(
 *   id = "token_auth",
 *   label = @Translation("Token auth"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hello_world\TokenAuthListBuilder",
 *     "form" = {
 *       "add" = "Drupal\hello_world\Form\TokenAuthForm",
 *       "edit" = "Drupal\hello_world\Form\TokenAuthForm",
 *       "delete" = "Drupal\hello_world\Form\TokenAuthDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\hello_world\TokenAuthHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "token_auth",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/token_auth/{token_auth}",
 *     "add-form" = "/admin/structure/token_auth/add",
 *     "edit-form" = "/admin/structure/token_auth/{token_auth}/edit",
 *     "delete-form" = "/admin/structure/token_auth/{token_auth}/delete",
 *     "collection" = "/admin/structure/token_auth"
 *   }
 * )
 */
class TokenAuth extends ConfigEntityBase implements TokenAuthInterface {

  /**
   * The Token auth ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Token auth label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Token.
   *
   * @var string
   */
  protected $token;

  /**
   * The Token activation.
   *
   * @var boolean
   */
  protected $active;

  /**
   * {@inheritdoc|}
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * {@inheritdoc|}
   */
  public function getActive() {
    return $this->active? "Active" : "Inactive";
  }

}
