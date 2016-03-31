<?php

namespace Davidino\TripSort\BoardingCard;

use Davidino\TripSort\Contract\BoardingCardInterface;
use Davidino\TripSort\Trip;

class TrainBoardingCard implements BoardingCardInterface
{
    /**
     * @var string
     */
    private $trainNumber;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $seat;

    /**
     * TrainBoardingCard constructor.
     * @param string $trainNumber
     * @param Trip $trip
     * @param string|null $seat
     */
    public function __construct(string $trainNumber, Trip $trip, string $seat = null)
    {
        $this->trainNumber = $trainNumber;
        $this->from = $trip->from;
        $this->destination  = $trip->destination;
        $this->seat = $seat;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier() :string
    {
        return $this->trainNumber;
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
        return "Take train $this->trainNumber from $this->from to $this->destination. ".
               ($this->seat ? "Sit in seat $this->seat." : "No seat assignment." );
    }

}
