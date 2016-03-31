<?php

namespace Davidino\TripSort\Exception;

class CannotCreateTripWithSamePoint extends  \Exception
{
    public function __construct()
    {
        parent::__construct('Departure and Destination cannot be the same', 0, null);
    }
}