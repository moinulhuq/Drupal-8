<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Inventory entities.
 *
 * @ingroup hello_world
 */
class InventoryListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Inventory ID');
    $header['track']  = $this->t('Track');
    $header['name']  = $this->t('Name');
    $header['image']  = $this->t('Image');
    $header['content']  = $this->t('Content');
    $header['category']  = $this->t('Category');
    $header['semicategory']  = $this->t('Semicategory');
    $header['size']  = $this->t('Size');
    $header['uri']  = $this->t('URI');
    $header['description']  = $this->t('Description');
    $header['brief']  = $this->t('Brief');
    $header['email']  = $this->t('Email');
    $header['telephone']  = $this->t('Telephone');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\hello_world\Entity\Inventory */
    $row['id'] = $entity->id();
    $row['track']  = $entity->track->value;
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.inventory.canonical',
      ['inventory' => $entity->id()]
    );
    $row['image']  = $entity->image->value;
    $row['content']  = $entity->content->value;
    $row['category']  = $entity->category->value;
    $row['semicategory']  = $entity->semicategory->value;
    $row['size']  = $entity->size->value;
    $row['uri']  = $entity->uri->value;
    $row['description']  = $entity->description->value;
    $row['brief']  = $entity->brief->value;
    $row['email']  = $entity->email->value;
    $row['telephone']  = $entity->telephone->value;
    return $row + parent::buildRow($entity);
  }

}
