<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contact person entities.
 *
 * @ingroup hello_world
 */
interface ContactPersonInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contact person name.
   *
   * @return string
   *   Name of the Contact person.
   */
  public function getName();

  /**
   * Sets the Contact person name.
   *
   * @param string $name
   *   The Contact person name.
   *
   * @return \Drupal\hello_world\Entity\ContactPersonInterface
   *   The called Contact person entity.
   */
  public function setName($name);

  /**
   * Gets the Contact person creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Contact person.
   */
  public function getCreatedTime();

  /**
   * Sets the Contact person creation timestamp.
   *
   * @param int $timestamp
   *   The Contact person creation timestamp.
   *
   * @return \Drupal\hello_world\Entity\ContactPersonInterface
   *   The called Contact person entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Contact person published status indicator.
   *
   * Unpublished Contact person are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Contact person is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Contact person.
   *
   * @param bool $published
   *   TRUE to set this Contact person to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\hello_world\Entity\ContactPersonInterface
   *   The called Contact person entity.
   */
  public function setPublished($published);

  /**
   * Gets the Contact person revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Contact person revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\hello_world\Entity\ContactPersonInterface
   *   The called Contact person entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Contact person revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Contact person revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\hello_world\Entity\ContactPersonInterface
   *   The called Contact person entity.
   */
  public function setRevisionUserId($uid);

  /**
   * Gets the Contact person type.
   *
   * @return string
   *   Type of the Contact person.
   */
  public function getContactType();

}
