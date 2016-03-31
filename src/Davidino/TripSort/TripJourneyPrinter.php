<?php

namespace Davidino\TripSort;

use Davidino\TripSort\Contract\BoardingCardInterface;

class TripJourneyPrinter
{
    /**
     * @param TripSorter $trip
     * @return string
     */
    public static function printJourney(TripSorter $trip) : string
    {
        $output = '';

        /** @var BoardingCardInterface $card */
        foreach ($trip->getSortedCards() as $i => $card) {
            $output .=  ($i+1) . '. ' .$card->printInfo() . "\n";
        }

        $output .= count($trip->getSortedCards())+1 . ". You have arrived at your final destination.";

        return $output;
    }
}
