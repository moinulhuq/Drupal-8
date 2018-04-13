<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Your are Authenticate to view this page'),
    ];
  }

  /**
   * Custom access check.
   *
   * @return AccessResult
   *   access checking done against this account.
   */
  public function custom_access_check(AccountInterface $account) {

    //replace of _role: 'administrator' && _user_is_logged_in: 'TRUE' or _permission: 'access content'

    if(in_array('administrator', $account->getRoles()) && $account->hasPermission('access content') && !$account->isAnonymous()) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();

  }

}
