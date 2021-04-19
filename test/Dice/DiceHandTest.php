<?php

declare(strict_types=1);

namespace alos17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class DiceHandTest extends TestCase
{
    /**
     * Test the function skapandet av dice objekt.
     */
    public function testDiceHandObject()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\alos17\Dice\DiceHand", $dicehand);
    }

    public function testDiceHandTossAll()
    {
        $dicehand = new DiceHand(2);
        $dicehand->tossAll();
        $diceArrayValue = $dicehand->getAllDices();
        $this->assertEquals(count($diceArrayValue), 2);
    }

    public function testDiceHandTossOne()
    {
        $dicehand = new DiceHand(2);
        $dicehand->tossSpecific(1);
        $diceArrayValue = $dicehand->getAllDices();
        $this->assertEquals(count($diceArrayValue), 2);
    }

    public function testDiceHandGraphic()
    {
        $tempValues = [4];
        $dicehand = new DiceHand(1);
        $dicehand->tossAll();
        $dicehand->setAllDices($tempValues);
        $diceArrayValue = $dicehand->getAllDicesGraphic();
        $this->assertEquals($diceArrayValue[0], "dice-4");
    }

    public function testDiceHandSum()
    {
        $dicehand = new DiceHand(3);
        $dicehand->tossAll();
        $diceArrayValue = $dicehand->getAllDices();
        $sum = $dicehand->getSumHand();

        $diceArraySize = count($diceArrayValue);
        $total = 0;
        for ($i=0; $i < $diceArraySize; $i++) { 
            $total = $total + $diceArrayValue[$i];
        }
        $this->assertEquals($total, $sum);
    }

    public function testDiceHandSetAll()
    {
        $tempValues = [1, 4, 5];
        $tempValuesTotal = 10;
        $dicehand = new DiceHand(3);
        $dicehand->tossAll();
        $dicehand->setAllDices($tempValues);
        $diceArrayValue = $dicehand->getAllDices();

        for ($i=0; $i < 3; $i++) { 
            $this->assertEquals($tempValues[$i], $diceArrayValue[$i]);
        }
    }

}
