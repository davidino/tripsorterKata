<?php

namespace Davidino\TripSort\Exception;

class CannotConnectAllTheBoardingCard extends  \Exception
{
    public function __construct()
    {
        parent::__construct('Cannot connect all the cards', 0, null);
    }
}