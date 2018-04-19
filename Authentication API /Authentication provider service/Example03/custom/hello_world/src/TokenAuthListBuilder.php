<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Token auth entities.
 */
class TokenAuthListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Label');
    $header['token'] = $this->t('Token');
    $header['active'] = $this->t('Active');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['token'] = $entity->getToken();
    $row['active'] = $entity->getActive();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
