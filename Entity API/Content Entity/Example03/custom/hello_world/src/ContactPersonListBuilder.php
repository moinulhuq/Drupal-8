<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Contact person entities.
 *
 * @ingroup hello_world
 */
class ContactPersonListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Contact person ID');
    $header['name'] = $this->t('Name');
    $header['type'] = $this->t('Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\hello_world\Entity\ContactPerson */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.contact_person.edit_form',
      ['contact_person' => $entity->id()]
    );
    $row['type'] = $entity->getContactType();

    return $row + parent::buildRow($entity);
  }

}
