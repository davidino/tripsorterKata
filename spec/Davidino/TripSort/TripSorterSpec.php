<?php

namespace spec\Davidino\TripSort;

use Davidino\TripSort\BoardingCard\TrainBoardingCard;
use Davidino\TripSort\Exception\CannotConnectAllTheBoardingCard;
use Davidino\TripSort\Exception\CannotSortTripWithoutCard;
use Davidino\TripSort\Trip;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TripSorterSpec extends ObjectBehavior
{
    function it_should_throw_an_exception_when_initialized_without_boarding_card() {
        $this->beConstructedWith([]);
        $this->shouldThrow(new CannotSortTripWithoutCard())->duringInstantiation();
    }

    function it_should_handle_one_board_card()
    {
        $MilanRome = new TrainBoardingCard('10A', new Trip("Milan", "Rome"));

        $this->beConstructedWith([$MilanRome]);
        $this->getSortedCards()->shouldBeEqualTo([$MilanRome]);
    }

    function it_should_sort_adding_on_top()
    {
        $MilanRome = new TrainBoardingCard('10A', new Trip("Milan", "Rome"));
        $ParisMilan = new TrainBoardingCard('10B', new  Trip("Paris", "Milan"));

        $this->beConstructedWith([$MilanRome, $ParisMilan]);
        $this->getSortedCards()->shouldBeEqualTo([$ParisMilan, $MilanRome]);
    }

    function it_should_sort_adding_as_last()
    {

        $ParisMilan = new TrainBoardingCard('10A', new Trip("Paris", "Milan"));
        $MilanRome = new TrainBoardingCard('11B', new Trip("Milan", "Rome"));

        $this->beConstructedWith([$ParisMilan, $MilanRome]);
        $this->getSortedCards()->shouldBeEqualTo([$ParisMilan, $MilanRome]);
    }

    function it_should_be_able_to_replace_the_first_element()
    {
         $milanRome   = new TrainBoardingCard('10A', new Trip("Milan", "Rome"));
         $parisMilan  = new TrainBoardingCard('10B', new Trip("Paris", "Milan"));
         $lisbonParis = new TrainBoardingCard('10C', new Trip("Lisbon", "Paris"));

        $this->beConstructedWith([$milanRome, $parisMilan, $lisbonParis]);
        $this->getSortedCards()->shouldBeEqualTo([$lisbonParis, $parisMilan, $milanRome]);
    }

    function it_should_handle_the_card_that_is_not_yet_connectable()
    {
        $parisMilan =new TrainBoardingCard('10A', new Trip("Paris", "Milan"));
        $lisbonParis = new TrainBoardingCard('10C', new Trip("Lisbon", "Paris"));
        $romeNaples = new TrainBoardingCard('10Z', new Trip("Rome", "Naples"));
        $milanRome  =  new TrainBoardingCard('10K', new Trip("Milan", "Rome"));

        $this->beConstructedWith([$parisMilan, $lisbonParis, $romeNaples, $milanRome]);
        $this->getSortedCards()->shouldBeEqualTo([$lisbonParis, $parisMilan, $milanRome, $romeNaples]);
    }

    function it_should_handle_the_roundtrip()
    {

        $milanParis = new TrainBoardingCard('10A', new Trip("Milan", "Paris"));
        $parisMilan = new TrainBoardingCard('10B', new Trip("Paris", "Milan"));

        $this->beConstructedWith([$milanParis, $parisMilan]);
        $this->getSortedCards()->shouldBeEqualTo([$parisMilan, $milanParis]);
    }

    function it_should_throw_an_exception_when_not_all_card_are_not_connected()
    {
        $this->beConstructedWith([
            new TrainBoardingCard('10S', new Trip("Rome", "Milan")),
            new TrainBoardingCard('10B', new Trip("Milan", "Paris")),
            new TrainBoardingCard('10W', new Trip("Paris", "Rome")),
            new TrainBoardingCard('10T', new Trip("Milan", "Turin")),
        ]);

        $this->shouldThrow(new CannotConnectAllTheBoardingCard('Cannot connect all the cards'))->duringInstantiation();
    }

    function it_should_add_a_card()
    {
        $romeMilan  = new TrainBoardingCard('10S', new Trip("Rome", "Milan"));
        $milanParis = new TrainBoardingCard('10B', new Trip("Milan", "Paris"));
        $parisGeneve  = new TrainBoardingCard('10W', new Trip("Paris", "Geneve"));
        $GeneveNaples = new TrainBoardingCard('10A', new Trip("Geneve", "Naples"));

        $this->beConstructedWith([$romeMilan , $milanParis, $parisGeneve]);
        $this->addBoardingCard($GeneveNaples);

        $this->getSortedCards()->shouldBeEqualTo([$romeMilan , $milanParis, $parisGeneve, $GeneveNaples]);
    }

    function it_should_throw_an_error_adding_a_card_not_connectable()
    {
        $romeMilan  = new TrainBoardingCard('10S', new Trip("Rome", "Milan"));
        $milanParis = new TrainBoardingCard('10B', new Trip("Milan", "Paris"));
        $parisGeneve  = new TrainBoardingCard('10W', new Trip("Paris", "Geneve"));
        $NizzaNaples = new TrainBoardingCard('10A', new Trip("Nizza", "Naples"));

        $this->beConstructedWith([$romeMilan , $milanParis, $parisGeneve]);

        $this->shouldThrow(new CannotConnectAllTheBoardingCard())->during('addBoardingCard',[$NizzaNaples]);
    }


}
