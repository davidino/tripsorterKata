<?php

namespace spec\Davidino\TripSort;

use Davidino\TripSort\BoardingCard\AirplaneBoardingCard;
use Davidino\TripSort\BoardingCard\BusBoardingCard;
use Davidino\TripSort\BoardingCard\TrainBoardingCard;
use Davidino\TripSort\Trip;
use Davidino\TripSort\TripSorter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TripJourneyPrinterSpec extends ObjectBehavior
{
    function it_should_print_the_journey(TripSorter $trip)
    {
        $romeMilan  = new TrainBoardingCard('10S', new Trip("Rome", "Milan"));
        $milanParis = new TrainBoardingCard('10B', new Trip("Milan", "Paris"));

        $this->beConstructedThrough('printJourney', [$trip]);

        $trip->getSortedCards()->willReturn([
            $romeMilan, $milanParis
        ]);

        $this->shouldBeEqualTo(
             '1. Take train 10S from Rome to Milan. No seat assignment.'  . "\n"
            .'2. Take train 10B from Milan to Paris. No seat assignment.' . "\n"
            .'3. You have arrived at your final destination.'
        );
    }

    function it_should_print_the_complete_journey()
    {
        $a = new TrainBoardingCard('78A', new Trip('Madrid', 'Barcelona'), '45B');
        $b = new BusBoardingCard('airport bus', new Trip('Barcelona', 'Gerona Airport'));
        $c = new AirplaneBoardingCard('SK455', new Trip('Gerona Airport', 'Stockholm'), '45B', '3A', '344');
        $d = new AirplaneBoardingCard('SK22', new Trip('Stockholm', 'New York JFK'), '22', '7B');

        $tripSorter = new TripSorter([$a, $b, $c, $d]);

        $this->beConstructedThrough('printJourney', [$tripSorter]);

        $this->shouldBeEqualTo(
            "1. Take train 78A from Madrid to Barcelona. Sit in seat 45B." . "\n"
            . "2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment." . "\n"
            . "3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344." . "\n"
            . "4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg." . "\n"
            . "5. You have arrived at your final destination."
        );
    }
}
