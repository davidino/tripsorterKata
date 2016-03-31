<?php

namespace Davidino\TripSort\BoardingCard;

use Davidino\TripSort\Contract\BoardingCardInterface;
use Davidino\TripSort\Trip;

class BusBoardingCard implements BoardingCardInterface
{

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $busNumber;

    /**
     * @var string || null
     */
    private $seat;

    /**
     * @var string
     */
    private $destination;

    /**
     * BusBoardingCard constructor.
     * @param string $busNumber
     * @param Trip $trip
     * @param string|null $seat
     */
    public function __construct(string $busNumber, Trip $trip, string $seat = null)
    {
        $this->busNumber = $busNumber;
        $this->from = $trip->from;
        $this->seat = $seat;
        $this->destination = $trip->destination;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier() :string
    {
        return $this->busNumber;
    }

    /**
     * @inheritDoc
     */
    public function getFrom() :string
    {
        return $this->from;
    }

    /**
     * @inheritDoc
     */
    public function getDestination() :string
    {
        return $this->destination;
    }

    /**
     * @inheritDoc
     */
    public function printInfo() :string
    {
        return "Take the $this->busNumber from $this->from to $this->destination. "
                . ($this->seat ? "Sit in seat $this->seat." : "No seat assignment." );
    }
}
