<?php

namespace spec\Davidino\TripSort;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Davidino\TripSort\Exception\CannotCreateTripWithSamePoint;

class TripSpec extends ObjectBehavior
{
    function it_should_throw_an_exception_when_to_and_from_are_the_same()
    {
        $this->beConstructedWith('Rome', 'Rome');
        $this->shouldThrow(new CannotCreateTripWithSamePoint())->duringInstantiation();
    }
}
