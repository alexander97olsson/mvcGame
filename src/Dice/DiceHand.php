<?php

declare(strict_types=1);

namespace alos17\Dice;

class DiceHand
{
    private $dices = [];
    private $dicesValues = [];
    private $dicesGraphics = [];

    public function __construct(int $dices = 2)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[] = new DiceGraphic();
        }
    }

    public function tossAll()
    {
        $numberOfDices = count($this->dices);
        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dices[$i]->toss();
        }
    }

    public function tossSpecific(int $dicesChosen)
    {
        $this->dices[$dicesChosen]->toss();
    }

    public function getAllDices()
    {
        $numberOfDices = count($this->dices);
        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dicesValues[] = $this->dices[$i]->getLastToss();
        }
        return $this->dicesValues;
    }

    public function getAllDicesGraphic()
    {
        $numberOfDices = count($this->dices);
        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dicesGraphics[] = $this->dices[$i]->graphics();
        }
        return $this->dicesGraphics;
    }

    public function getSumHand()
    {
        return array_sum($this->dicesValues);
    }

    public function setAllDices($val)
    {
        $numberOfDices = count($this->dices);
        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dices[$i]->setLastToss($val[$i]);
        }
    }
}
