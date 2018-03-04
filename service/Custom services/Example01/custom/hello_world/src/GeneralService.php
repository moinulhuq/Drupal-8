<?php

namespace Drupal\hello_world;

/**
 * Class GeneralService.
 */
class GeneralService {

    protected $data;

    /**
    * Constructs a new GeneralService object.
    */
    public function __construct() {
        $this->data = 'Hello World!';
    }

    /**
     * Constructs a new GeneralService object.
     */
    public function getHello() {
        return $this->data;
    }

}
