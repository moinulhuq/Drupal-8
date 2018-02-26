<?php

namespace Drupal\hello_world\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

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
    $events['kernel.request'] = ['onKernelRequest'];
    return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function onKernelRequest(Event $event) {

      if(\Drupal::currentUser()->isAnonymous()){
          drupal_set_message('Your are Anonymous', 'status', TRUE);
      }else{
          drupal_set_message('Welcome to our website', 'status', TRUE);
      }
  }

}
