<?php

namespace Davidino\TripSort\Contract;

interface BoardingCardInterface {

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getFrom();

    /**
     * @return string
     */
    public function getDestination();


    /**
     * @return void
     */
    public function printInfo();
}