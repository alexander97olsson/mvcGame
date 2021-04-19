<?php

declare(strict_types=1);

namespace alos17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Test the function skapandet av dice objekt.
     */
    public function testDiceGraphicObject()
    {
        $diceGraphic = new DiceGraphic();
        $this->assertInstanceOf("\alos17\Dice\DiceGraphic", $diceGraphic);
    }

    public function testGraphic()
    {
        $diceGraphic = new DiceGraphic();
        $diceGraphic->toss();
        $diceGraphic->setLastToss(3);
        $value = $diceGraphic->graphics();
        $this->assertEquals($value, "dice-3");
    }
}
