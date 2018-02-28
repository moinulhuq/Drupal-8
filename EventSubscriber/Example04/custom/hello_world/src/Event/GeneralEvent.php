<?php

namespace Drupal\hello_world\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class GeneralEvent.
 */
class GeneralEvent extends Event {

    protected $event;

    /**
     * Constructs a new GeneralEvent object.
     */
    public function __construct($event) {
        $this->event= $event;
    }

    /**
     * Get event
     */
    public function getData() {
        return $this->event;
    }

}
