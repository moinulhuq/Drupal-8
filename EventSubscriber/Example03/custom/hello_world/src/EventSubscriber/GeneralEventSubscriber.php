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
    $events['general.event'][] = ['doSomeAction'];
    return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GeneralEvent $event
   */
  public function doSomeAction(GeneralEvent $event) {

      // Get data
      drupal_set_message("Hello World : ".$event->getData());
      $event->display();

      $event->setData("Tanim");

      // Get data
      drupal_set_message("Hello World again : ".$event->getData());
      $event->display();

  }

}
