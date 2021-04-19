<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller diceGame.
 */
class ControllerDiceGameTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new DiceGame();
        $this->assertInstanceOf("\Mos\Controller\DiceGame", $controller);
    }

    public function testStartGame()
    {
        $controller = new DiceGame();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_POST["dices"] = 2;
        $res = $controller->gameStart();
        $this->assertInstanceOf("\Mos\Controller\DiceGame", $controller);
    }

    public function testStopGame()
    {
        $controller = new DiceGame();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_POST["dices"] = 2;
        $_POST["stop"] = "Stop";
        $res = $controller->gameStart();
        $this->assertInstanceOf("\Mos\Controller\DiceGame", $controller);
    }

    public function testRestart()
    {
        $controller = new DiceGame();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_POST["dices"] = 2;
        $_SESSION["stopGame"] = "stop";
        $res = $controller->gameStart();
        $this->assertInstanceOf("\Mos\Controller\DiceGame", $controller);
    }

    public function testRestartWithStop()
    {
        $controller = new DiceGame();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_POST["dices"] = 2;
        $res = $controller->gameStart();
        $_SESSION["stopGame"] = "not";
        $res = $controller->restart();
        $this->assertInstanceOf("\Mos\Controller\DiceGame", $controller);
    }

}
