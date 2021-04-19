<?php

declare(strict_types=1);

namespace alos17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class DiceTest extends TestCase
{
    /**
     * Test the function skapandet av dice objekt.
     */
    public function testDiceObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\alos17\Dice\Dice", $dice);
    }
    /**
     * Test om man får något värde vid kast.
     */
    public function testDiceToss()
    {
        $diceArray = [1, 2, 3, 4, 5, 6];
        $dice = new Dice(6);
        $dice->toss();
        $lastToss = $dice->getLastToss();
        $this->assertIsInt($lastToss);
        $this->assertContains($lastToss, $diceArray);
    }
    /**
     * Testar om värdet man sätter stämmer
     */
    public function testSetDice()
    {
        $dice = new Dice(6);
        $dice->toss();
        $dice->setLastToss(3);
        $lastToss = $dice->getLastToss();
        $this->assertEquals($lastToss, 3);
    }
}
