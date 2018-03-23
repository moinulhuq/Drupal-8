<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contact person entities.
 *
 * @ingroup hello_world
 */
interface ContactPersonInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contact person name.
   *
   * @return string
   *   Name of the Contact person.
   */
  public function getName();

  /**
   * Gets the image.
   *
   * @return image
   *   Image of the Contact address.
   */
  public function getImage();

  /**
   * Gets the gender.
   *
   * @return string
   *   Gender of the Contact address.
   */
  public function getGender();

  /**
   * Gets the email.
   *
   * @return string
   *   Email of the Contact address.
   */
  public function getEmail();

  /**
   * Gets the telephone.
   *
   * @return string
   *   Telephone of the Contact address.
   */
  public function getTelephone();

  /**
   * Gets the address.
   *
   * @return string
   *   Address of the Contact address.
   */
  public function getAddress();

}
