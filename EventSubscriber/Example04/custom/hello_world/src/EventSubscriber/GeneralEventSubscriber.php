<?php

namespace Drupal\hello_world\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\hello_world\Event\GeneralEvent;

/**
 * Class GeneralEventSubscriber.
 */
class GeneralEventSubscriber implements EventSubscriberInterface {

  /**
   * Constructs a new GeneralEventSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
      $events['hello_world.logEmailDownload'][] = ['logEmailDownload'];
      $events['hello_world.logMediaDownload'][] = ['logMediaDownload'];
      return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GeneralEvent $event
   */
  public function logEmailDownload(GeneralEvent $event) {

      \Drupal::logger('log_message')->notice($event->getData());
  }

  /**
  * This method is called whenever the kernel.request event is
  * dispatched.
  *
  * @param GeneralEvent $event
  */
  public function logMediaDownload(GeneralEvent $event) {

      \Drupal::logger('log_message')->notice($event->getData());
  }

}
