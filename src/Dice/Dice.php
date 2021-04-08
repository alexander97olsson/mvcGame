<?php

declare(strict_types=1);

namespace alos17\Dice;

class Dice
{
    private $sides;
    protected $lastToss;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function toss()
    {
        $randValue = rand(1, $this->sides);
        $this->lastToss = $randValue;
    }

    public function getLastToss()
    {
        return $this->lastToss;
    }
}
