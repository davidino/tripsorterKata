<?php

namespace spec\Davidino\TripSort\BoardingCard;

use Davidino\TripSort\Trip;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrainBoardingCardSpec extends ObjectBehavior
{
    function it_should_return_start_and_end_points()
    {
        $this->beConstructedWith('10A',new Trip('Rome', 'Milan'));
        $this->getFrom()->shouldBeEqualTo('Rome');
        $this->getDestination()->shouldBeEqualTo('Milan');
    }
}
