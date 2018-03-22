<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Simple message entity.
 *
 * @ConfigEntityType(
 *   id = "simple_message",
 *   label = @Translation("Simple message"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\hello_world\SimpleMessageListBuilder",
 *     "form" = {
 *       "add" = "Drupal\hello_world\Form\SimpleMessageForm",
 *       "edit" = "Drupal\hello_world\Form\SimpleMessageForm",
 *       "delete" = "Drupal\hello_world\Form\SimpleMessageDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\hello_world\SimpleMessageHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "simple_message",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/simple_message/{simple_message}",
 *     "add-form" = "/admin/structure/simple_message/add",
 *     "edit-form" = "/admin/structure/simple_message/{simple_message}/edit",
 *     "delete-form" = "/admin/structure/simple_message/{simple_message}/delete",
 *     "collection" = "/admin/structure/simple_message"
 *   }
 * )
 */
class SimpleMessage extends ConfigEntityBase implements SimpleMessageInterface {

  /**
   * The Simple message ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Simple message label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Simple messgae label.
   *
   * @var string
   */
  protected $message;

  /**
   * {@inheritdoc|}
   */
  public function getMessage() {
      return $this->message;
  }

}
