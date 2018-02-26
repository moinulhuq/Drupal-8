The EventDispatcher component provides tools that allow your application components to communicate with each other by dispatching events and listening to them.

Step 1: Create Subscriber file

```php
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

  }

}

```

Step 2: List subscribed events

If your web page is requested then "onKernelRequest" function will call.
	
```php
  static function getSubscribedEvents() {
    $events['kernel.request'] = ['onKernelRequest'];
    return $events;
  }
```

Step 3: Add a function for subscribed event

This will check whether user is logged in o not.

```php
  public function onKernelRequest(Event $event) {

      if(\Drupal::currentUser()->isAnonymous()){
          drupal_set_message('Your are Anonymous', 'status', TRUE);
      }else{
          drupal_set_message('Welcome to our website', 'status', TRUE);
      }
  }
```

Step 4: Register your new service

"event_subscriber" tells Drupal that our class wants to subscribe to events that other modules are triggering.

```yml
services:
  hello_world.default:
    class: Drupal\hello_world\EventSubscriber\GeneralEventSubscriber
    arguments: []
    tags:
      - { name: event_subscriber }
```