<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Contact person entity.
 *
 * @see \Drupal\hello_world\Entity\ContactPerson.
 */
class ContactPersonAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\hello_world\Entity\ContactPersonInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished contact person entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published contact person entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit contact person entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete contact person entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add contact person entities');
  }

}
