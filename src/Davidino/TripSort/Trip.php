<?php

namespace Davidino\TripSort;

use Davidino\TripSort\Exception\CannotCreateTripWithSamePoint;

class Trip {

    /**
     * @var string
     */
    public $destination;

    /**
     * @var string
     */
    public $from;

    public function __construct(string $from, string $destination)
    {
        if ($from == $destination) {
            throw new CannotCreateTripWithSamePoint();
        }

        $this->from =  $from;
        $this->destination  = $destination;
    }
}