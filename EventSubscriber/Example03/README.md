How to define an Event, Dispatcher and Subscriber in Drupal 8?

Step01: Define your own Event by extending "Symfony\Component\EventDispatcher\Event"

```php
<?php

namespace Drupal\hello_world\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class GeneralEvent.
 */
class GeneralEvent extends Event {

    protected $data;

    /**
     * Constructs a new GeneralEvent object.
     */
    public function __construct($data) {
        $this>data= $data;
    }

    /**
     * Get data
     */
    public function getData() {
        return $this>data;
    }

    /**
     * Set data
     */
    public function setData($data) {
        $this>data = $data;
    }

    /**
     * Display data
     */
    public function display() {
        drupal_set_message("This is as an example event : ".$this>data);
    }


}
```

Step02: Then subscribe the event.

```php
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
      drupal_set_message("Hello World : ".$event>getData());
      $event>display();

      $event>setData("Tanim");

      // Get data
      drupal_set_message("Hello World again : ".$event>getData());
      $event>display();

  }

}
```

Step03: Register the event

```yml
services:
  hello_world.default:
    class: Drupal\hello_world\EventSubscriber\GeneralEventSubscriber
    arguments: []
    tags:
       { name: event_subscriber }
```

Step04: Dispatch the event where you need.

```php
use Drupal\hello_world\Event\GeneralEvent;

// Load dispatcher object through services.
$dispatcher = \Drupal::service('event_dispatcher');

// creating our event class object.
$event = new GeneralEvent("Moin");

// Dispatching the event through the ‘dispatch’  method,
// Passing event name and event object ‘$event’ as parameters.
$dispatcher>dispatch('general.event', $event);
```