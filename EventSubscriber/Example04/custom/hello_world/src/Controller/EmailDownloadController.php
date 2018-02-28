<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_world\Event\GeneralEvent;

/**
 * Class EmailDownloadController.
 */
class EmailDownloadController extends ControllerBase {

  /**
   * Email.
   *
   * @return array
   *   Return Hello string.
   */
  public function Email() {

    $file_path = \Drupal::request()->getPathInfo();
    $dispatcher = \Drupal::service('event_dispatcher');

    $event = new GeneralEvent($file_path);
    $dispatcher->dispatch('hello_world.logEmailDownload', $event);

    return [
        '#type' => 'markup',
        '#markup' => $event->getData(),
    ];

  }

}
