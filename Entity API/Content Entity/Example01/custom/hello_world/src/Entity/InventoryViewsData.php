<?php

namespace Drupal\hello_world\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Inventory entities.
 */
class InventoryViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
