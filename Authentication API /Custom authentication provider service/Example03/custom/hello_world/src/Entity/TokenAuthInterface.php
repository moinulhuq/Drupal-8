<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Token auth entities.
 */
interface TokenAuthInterface extends ConfigEntityInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * return token.
   *
   * @return string
   */
  public function getToken();

  /**
   * return active.
   *
   * @return boolean
   */
  public function getActive();

}
