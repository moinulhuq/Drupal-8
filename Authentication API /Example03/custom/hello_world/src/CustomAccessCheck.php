<?php

namespace Drupal\hello_world;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Access\AccessResult;

/**
 * Class CustomAccessCheck.
 * Typically, if you tag a service, your service class must also implement a corresponding interface.
 */
class CustomAccessCheck implements AccessInterface {

  protected $current_user;

  /**
   * Constructs a new CustomAccessCheck object.
   *
   * @param \Drupal\Core\Session\AccountProxy $current_user
   *  To get current user.
   */
  public function __construct(AccountProxy $current_user) {
    $this->current_user = $current_user;
  }

  /**
   * A custom access check.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access() {

    if(in_array('administrator', $this->current_user->getAccount()->getRoles()) && $this->current_user->getAccount()->hasPermission('access content') && !$this->current_user->getAccount()->isAnonymous()) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }


}
