<?php

namespace Drupal\hello_world;

/**
 * Class ToyotaService.
 */
class ToyotaService {

    protected $car;

    /**
    * Constructs a new ToyotaService object.
    */
    public function __construct(CarService $car) {
        $this->car = $car;
    }

    /**
     * getCar() method.
     */
    public function getCar() {
        return $this->car->getCompany();
    }

}
