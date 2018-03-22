<?php

namespace Drupal\hello_world\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Simple message entities.
 */
interface SimpleMessageInterface extends ConfigEntityInterface {

  /**
   * return Message.
   *
   * @return string
   */
  public function getMessage();

}
