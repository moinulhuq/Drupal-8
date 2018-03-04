<?php

namespace Drupal\hello_world;

/**
 * Class CarService.
 */
class CarService {

    protected $name;

    /**
     * Constructs a new CarService object.
     */
    public function __construct() {
        $this->name = 'Toyato';
    }

    /**
     * getName() method.
     */
    public function getName() {
        return $this->name;
    }

}
