<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_world\Event\GeneralEvent;

/**
 * Class MediaDownloadController.
 */
class MediaDownloadController extends ControllerBase {

  /**
   * Media.
   *
   * @return array
   *   Return Hello string.
   */
  public function Media() {

    $file_path = \Drupal::request()->getPathInfo();
    $dispatcher = \Drupal::service('event_dispatcher');

    $event = new GeneralEvent($file_path);
    $dispatcher->dispatch('hello_world.logMediaDownload', $event);

    return [
      '#type' => 'markup',
      '#markup' => $event->getData(),
    ];

  }

}
