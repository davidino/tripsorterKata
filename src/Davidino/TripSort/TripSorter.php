<?php

namespace Davidino\TripSort;

use Davidino\TripSort\Contract\BoardingCardInterface;
use Davidino\TripSort\Exception\CannotConnectAllTheBoardingCard;
use Davidino\TripSort\Exception\CannotSortTripWithoutCard;

class TripSorter
{
    private $cards;
    private $sorted  = [];

    CONST LIMIT_LOOP = 10;

    /**
     * TripSorter constructor.
     * @param BoardingCardInterface[] $cards
     *
     * @throws CannotConnectAllTheBoardingCard
     * @throws CannotSortTripWithoutCard
     * @throws \InvalidArgumentException
     */
    public function __construct(array $cards)
    {
        if (count($cards) === 0) {
            throw new CannotSortTripWithoutCard();
        }

        foreach ($cards as $card) {
            if (!$card instanceof BoardingCardInterface) {
                throw new \InvalidArgumentException('Only BoardingCardInterface are accepted');
            }
        }

        $this->cards = $cards;
        $this->sorted = $this->sort();
    }

    /**
     * @param BoardingCardInterface $card
     *
     * @throws CannotConnectAllTheBoardingCard
     */
    public function addBoardingCard(BoardingCardInterface $card)
    {
        $this->cards[] = $card;
        $this->sorted  = $this->sort();
    }

    /**
     * @return array
     *
     * @throws CannotConnectAllTheBoardingCard
     */
    private function sort(): array
    {
        $sort = $this->sorted;
        $cycle = [];

        /** @var BoardingCardInterface $currFirstCard */
        $currFirstCard = null;

        while($this->cards) {
            /** @var BoardingCardInterface  $cardToOrder  */
            $cardToOrder = array_shift($this->cards);

            //add as first
            if( count($sort) == 0 ||
                ($currFirstCard && $this->areCardsConnected($cardToOrder, $currFirstCard))
            ) {
                $currFirstCard = $cardToOrder;
                array_unshift($sort, $cardToOrder);
                continue;
            }

            //add as last
            /** @var BoardingCardInterface $currLastCard */
            $currLastCard = $sort[count($sort)-1];
            if ( $this->areCardsConnected($currLastCard, $cardToOrder)) {
                array_push($sort, $cardToOrder);
                continue;
            }

            // the card is not yet connectable
            // put it back on the stack
            // and try later
            $idx = $cardToOrder->getIdentifier();
            $cycle[$idx] = (!array_key_exists($idx, $cycle) ? 1 : ++$cycle[$idx] );
            if ($cycle[$idx] > self::LIMIT_LOOP || count($this->cards) === 0) {
                throw new CannotConnectAllTheBoardingCard();
            }

            array_push($this->cards, $cardToOrder);
        }

        return $sort;
    }

    /**
     * @param BoardingCardInterface $cardA
     * @param BoardingCardInterface $cardB
     *
     * @return bool
     */
    protected function areCardsConnected(BoardingCardInterface $cardA, BoardingCardInterface $cardB): bool
    {
        return $cardA->getDestination() == $cardB->getFrom();
    }

    /**
     * @return array
     */
    public function getSortedCards(): array
    {
        return $this->sorted;
    }
}
