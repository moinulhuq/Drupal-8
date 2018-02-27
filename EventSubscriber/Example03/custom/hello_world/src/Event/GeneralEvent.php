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
        $this->data= $data;
    }

    /**
     * Get data
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * Display data
     */
    public function display() {
        drupal_set_message("This is as an example event : ".$this->data);
    }


}
