<?php

namespace Drupal\hello_world\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\hello_world\Entity\ContactPersonInterface;

/**
 * Class ContactPersonController.
 *
 *  Returns responses for Contact person routes.
 */
class ContactPersonController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Contact person  revision.
   *
   * @param int $contact_person_revision
   *   The Contact person  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($contact_person_revision) {
    $contact_person = $this->entityManager()->getStorage('contact_person')->loadRevision($contact_person_revision);
    $view_builder = $this->entityManager()->getViewBuilder('contact_person');

    return $view_builder->view($contact_person);
  }

  /**
   * Page title callback for a Contact person  revision.
   *
   * @param int $contact_person_revision
   *   The Contact person  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($contact_person_revision) {
    $contact_person = $this->entityManager()->getStorage('contact_person')->loadRevision($contact_person_revision);
    return $this->t('Revision of %title from %date', ['%title' => $contact_person->label(), '%date' => format_date($contact_person->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Contact person .
   *
   * @param \Drupal\hello_world\Entity\ContactPersonInterface $contact_person
   *   A Contact person  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(ContactPersonInterface $contact_person) {
    $account = $this->currentUser();
    $langcode = $contact_person->language()->getId();
    $langname = $contact_person->language()->getName();
    $languages = $contact_person->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $contact_person_storage = $this->entityManager()->getStorage('contact_person');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $contact_person->label()]) : $this->t('Revisions for %title', ['%title' => $contact_person->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all contact person revisions") || $account->hasPermission('administer contact person entities')));
    $delete_permission = (($account->hasPermission("delete all contact person revisions") || $account->hasPermission('administer contact person entities')));

    $rows = [];

    $vids = $contact_person_storage->revisionIds($contact_person);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\hello_world\ContactPersonInterface $revision */
      $revision = $contact_person_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $contact_person->getRevisionId()) {
          $link = $this->l($date, new Url('entity.contact_person.revision', ['contact_person' => $contact_person->id(), 'contact_person_revision' => $vid]));
        }
        else {
          $link = $contact_person->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.contact_person.translation_revert', ['contact_person' => $contact_person->id(), 'contact_person_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.contact_person.revision_revert', ['contact_person' => $contact_person->id(), 'contact_person_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.contact_person.revision_delete', ['contact_person' => $contact_person->id(), 'contact_person_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['contact_person_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
