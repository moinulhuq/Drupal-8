<?php

namespace Drupal\hello_world;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface ContactPersonStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Contact person revision IDs for a specific Contact person.
   *
   * @param \Drupal\hello_world\Entity\ContactPersonInterface $entity
   *   The Contact person entity.
   *
   * @return int[]
   *   Contact person revision IDs (in ascending order).
   */
  public function revisionIds(ContactPersonInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Contact person author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Contact person revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\hello_world\Entity\ContactPersonInterface $entity
   *   The Contact person entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(ContactPersonInterface $entity);

  /**
   * Unsets the language for all Contact person with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
