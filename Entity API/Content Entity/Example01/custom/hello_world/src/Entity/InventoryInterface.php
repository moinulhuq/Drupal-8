<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Inventory entities.
 *
 * @ingroup hello_world
 */
interface InventoryInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Inventory name.
   *
   * @return string
   *   Name of the Inventory.
   */
  public function getName();

  /**
   * Sets the Inventory name.
   *
   * @param string $name
   *   The Inventory name.
   *
   * @return \Drupal\hello_world\Entity\InventoryInterface
   *   The called Inventory entity.
   */
  public function setName($name);

  /**
   * Gets the Inventory creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Inventory.
   */
  public function getCreatedTime();

  /**
   * Sets the Inventory creation timestamp.
   *
   * @param int $timestamp
   *   The Inventory creation timestamp.
   *
   * @return \Drupal\hello_world\Entity\InventoryInterface
   *   The called Inventory entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Inventory published status indicator.
   *
   * Unpublished Inventory are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Inventory is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Inventory.
   *
   * @param bool $published
   *   TRUE to set this Inventory to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\hello_world\Entity\InventoryInterface
   *   The called Inventory entity.
   */
  public function setPublished($published);

}
