<?php

namespace Davidino\TripSort\Exception;

class CannotSortTripWithoutCard extends  \Exception
{
    public function __construct()
    {
        parent::__construct('Cannot sort the trip without cards', 0, null);
    }
}