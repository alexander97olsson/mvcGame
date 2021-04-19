<?php

declare(strict_types=1);

namespace alos17\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class YatzyTest extends TestCase
{
    /**
     * Test the function skapandet av dice objekt.
     */
    public function testYatzyObject()
    {
        $yatzyGame = new Yatzy();
        $this->assertInstanceOf("\alos17\Yatzy\Yatzy", $yatzyGame);
    }

    public function testYatzyTestScore()
    {
        $controller = new Yatzy();
        $controller->showGame();
        $_SESSION["counter"] = 3;
        $_SESSION["round"] = 7;
        $_SESSION["score"] = 65;
        $_SESSION["numberOfValues"] = [3, 4, 2, 2, 1];
        $score = $controller->getAllScores(2);
        $this->assertEquals($score, 4);
    }

    public function testYatzyTossAgain()
    {
        $controller = new Yatzy();
        $_POST["Toss"] = "Toss";
        $_POST["dicesArray"] = [1, 2, 3];
        $controller->showGame();
        $_SESSION["counter"] = 3;
        $_SESSION["round"] = 7;
        $_SESSION["score"] = 65;
        $_SESSION["numberOfValues"] = [3, 4, 2, 2, 1];
        $score = $controller->getAllScores(2);
        $this->assertEquals($score, 4);
    }

    public function testYatzyKeepAllDices()
    {
        $controller = new Yatzy();
        $_POST["Toss"] = "Toss";
        $_SESSION["numberOfValues"] = [3, 4, 2, 2, 1];
        $controller->showGame();
        $_SESSION["counter"] = 3;
        $_SESSION["round"] = 7;
        $_SESSION["score"] = 65;
        $score = $controller->getAllScores(2);
        $this->assertIsInt($score);
    }
}
