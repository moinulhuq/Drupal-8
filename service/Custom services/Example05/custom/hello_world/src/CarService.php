<?php

namespace Drupal\hello_world;

/**
 * Class CarService.
 */
class CarService {

    protected $company;

    /**
     * Constructs a new CarService object.
     */
    public function __construct($company) {
        $this->company = $company;
    }

    /**
     * getName() method.
     */
    public function getCompany() {
        return $this->company;
    }

}
