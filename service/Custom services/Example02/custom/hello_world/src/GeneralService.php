<?php

namespace Drupal\hello_world;

/**
 * Class GeneralService.
 */
class GeneralService {

    protected $booklist;
    protected $other;

    /**
    * Constructs a new GeneralService object.
    */
    public function __construct($booklist, $other) {
        $this->booklist = $booklist;
        $this->other = $other;
    }

    /**
     * Constructs a new GeneralService object.
     */
    public function getBooklist() {
        return $this->booklist;
    }

    /**
     * Constructs a new GeneralService object.
     */
    public function getOther() {
        return $this->other;
    }

}
