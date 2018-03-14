<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Simple message entities.
 */
class SimpleMessageListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Machine name');
    $header['label'] = $this->t('Simple message');
    $header['message'] = $this->t('Message Body');
    $header['messagetype'] = $this->t('Message Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['label'] = $entity->label();
    $row['message'] = $entity->message;
    $row['messagetype'] = $entity->getMessageType();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
