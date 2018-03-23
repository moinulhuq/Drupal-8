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
    $header['image'] = $this->t('Image');
    $header['gender'] = $this->t('Gender');
    $header['email'] = $this->t('Email');
    $header['telephone'] = $this->t('Telephone');
    $header['address'] = $this->t('Address');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\hello_world\Entity\ContactPerson */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->getName(),
      'entity.contact_person.edit_form',
      ['contact_person' => $entity->id()]
    );
    $row['image'] = $entity->getImage();
    $row['gender'] = $entity->getGender();
    $row['email'] = $entity->getEmail();
    $row['telephone'] = $entity->getTelephone();
    $row['address'] = $entity->getAddress();
    return $row + parent::buildRow($entity);
  }

}
