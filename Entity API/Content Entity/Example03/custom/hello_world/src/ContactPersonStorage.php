<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\hello_world\Entity\ContactPersonInterface;

/**
 * Defines the storage handler class for Contact person entities.
 *
 * This extends the base storage class, adding required special handling for
 * Contact person entities.
 *
 * @ingroup hello_world
 */
class ContactPersonStorage extends SqlContentEntityStorage implements ContactPersonStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(ContactPersonInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {contact_person_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {contact_person_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(ContactPersonInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {contact_person_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('contact_person_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
