<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Inventory entity.
 *
 * @see \Drupal\hello_world\Entity\Inventory.
 */
class InventoryAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\hello_world\Entity\InventoryInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished inventory entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published inventory entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit inventory entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete inventory entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add inventory entities');
  }

}
