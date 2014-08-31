<?php

namespace Gerob;

class BowlingGame
{
    private $rolls = [];

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;
        $ballNumber = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isSpare($ballNumber)) {
                $score += 10 + $this->spareBonus($ballNumber);
                $ballNumber += 2;
            } elseif ($this->isStrike($ballNumber)) {
                $score += 10 + $this->strikeBonus($ballNumber);
                $ballNumber += 1;
            } else {
                $score += $this->rolls[$ballNumber] + $this->rolls[$ballNumber + 1];
                $ballNumber += 2;
            }
        }
        return $score;
    }

    /**
     * @param $ballNumber
     * @return bool
     */
    protected function isSpare($ballNumber)
    {
        return 10 == $this->rolls[$ballNumber] + $this->rolls[$ballNumber + 1];
    }

    /**
     * @param $ballNumber
     * @return bool
     */
    protected function isStrike($ballNumber)
    {
        return 10 == $this->rolls[$ballNumber];
    }

    /**
     * @param $ballNumber
     * @return mixed
     */
    protected function spareBonus($ballNumber)
    {
        return $this->rolls[$ballNumber + 2];
    }

    protected function strikeBonus($ballNumber)
    {
        return $this->rolls[$ballNumber + 1] + $this->rolls[$ballNumber + 2];
    }
}
