<?php

namespace Davidino\TripSort\BoardingCard;

use Davidino\TripSort\Contract\BoardingCardInterface;
use Davidino\TripSort\Trip;

class AirplaneBoardingCard implements BoardingCardInterface
{
    /**
     * @var string
     */
    private $flightNumber;
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
     * @var string
     */
    private $gate;

    /**
     * @var string
     */
    private $ticketCounter;

    /**
     * AirplaneBoardingCard constructor.
     * @param string $flightNumber
     * @param Trip $trip
     * @param string $gate
     * @param string $seat
     * @param string|null $ticketCounter
     */
    public function __construct(string $flightNumber, Trip $trip, string $gate, string $seat, string $ticketCounter = null)
    {
        $this->from = $trip->from;
        $this->destination  = $trip->destination;
        $this->flightNumber = $flightNumber;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->ticketCounter = $ticketCounter;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier() :string
    {
        return $this->flightNumber;
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
    public function printInfo(): string
    {
        return "From $this->from, take flight $this->flightNumber to $this->destination. Gate $this->gate, seat $this->seat. "
               . ($this->ticketCounter ? "Baggage drop at ticket counter $this->ticketCounter." :
                                         "Baggage will we automatically transferred from your last leg.");
    }

}
