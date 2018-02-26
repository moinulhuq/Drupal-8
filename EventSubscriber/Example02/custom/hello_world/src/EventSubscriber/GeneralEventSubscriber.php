<?php

namespace Drupal\hello_world\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

      if(\Drupal::currentUser()->isAnonymous() && \Drupal::routeMatch()->getRouteName() !="user.login"){

          // To get base url
          $base_url = \Drupal::request()->getBaseUrl();

          // Redirect to login page.
          $route_name = \Drupal::routeMatch()->getRouteName();
          if (strpos($route_name, 'view') === 0 && strpos($route_name, 'rest_') !== FALSE) {
              return;
          }
          $response = new RedirectResponse($base_url.'/user/login', 301);
          $event->setResponse($response);
          $event->stopPropagation();
          return;

      }else{
          drupal_set_message('Welcome to our website', 'status', false);

      }
  }

}
