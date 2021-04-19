<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller diceGame.
 */
class ControllerYatzyGameTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Mos\Controller\YatzyGame", $controller);
    }

    public function testControllerReturnsResponse()
    {
        $controller = new YatzyGame();
        $_SESSION["counter"] = 3;
        $_SESSION["round"] = 7;
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->showGame();
        $this->assertInstanceOf($exp, $res);
    }
}
