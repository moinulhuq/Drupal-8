<?php

namespace Drupal\hello_world\Event;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class GeneralEvent.
 */
class GeneralEvent extends Event {

    protected $entity;

    /**
     * Constructs a new GeneralEvent object.
     */
    public function __construct(EntityInterface $entity) {
        $this->entity= $entity;
    }

    /**
     * Get event
     */
    public function getData() {
        return $this->entity;
    }

}
