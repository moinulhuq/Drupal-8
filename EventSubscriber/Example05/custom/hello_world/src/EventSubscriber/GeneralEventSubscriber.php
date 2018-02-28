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
      $events['hello_world.nodeInsert'][] = ['nodeInsert'];
      return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GeneralEvent $event
   */
  public function nodeInsert(GeneralEvent $event) {
    $entity = $event->getData();
    \Drupal::logger('log_message')->notice('New @type: @title.',
        [
            '@type' => $entity->getEntityType(),
            '@title' => $entity->label()
        ]);
  }
}
