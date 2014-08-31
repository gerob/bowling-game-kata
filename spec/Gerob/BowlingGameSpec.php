<?php

namespace spec\Gerob;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Gerob\BowlingGame');
    }

    function it_should_score_all_gutters()
    {
        $this->rollMany(20, 0);
        $this->score()->shouldBe(0);
    }

    function it_should_score_all_ones()
    {
        $this->rollMany(20, 1);
        $this->score()->shouldBe(20);
    }

    function it_should_score_a_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);
        $this->score()->shouldBe(16);
    }

    function it_should_score_a_strike()
    {
        $this->rollStrike();
        $this->roll(3);
        $this->roll(4);
        $this->rollMany(16, 0);
        $this->score()->shouldBe(24);
    }

    function it_should_score_a_perfect_game()
    {
        $this->rollMany(12, 10);
        $this->score()->shouldBe(300);
    }

    /**
     * @param $count
     * @param $pins
     */
    protected function rollMany($count, $pins)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->roll($pins);
        }
    }

    protected function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    protected function rollStrike()
    {
        $this->roll(10);
    }
}
