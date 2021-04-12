<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use alos17\Dice\DiceHand;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class DiceGame
{
    public function gameChoice(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();
        destroySession();
        $data = [
            "header" => "Game 21",
            "action" => url("/diceGame/gameStart"),
            "message" => "Choose one or two dices for the game!",
        ];

        $body = renderView("layout/dicestart.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function gameStart(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();
        $_SESSION["stopGame"] = $_SESSION["stopGame"] ?? "not";
        if (isset($_POST["stop"])) {
            $_SESSION["stopGame"] = "stop";
        } elseif (isset($_POST["dices"])) {
            $_SESSION["amount"] = intval($_POST["dices"]);
        }
        $data = [
            "header" => "Dice game",
            "message" => "This is the dice game 21!",
        ];
        if ($_SESSION["stopGame"] != "stop") {
            $diceGame = new DiceHand($_SESSION["amount"]);

            $diceGame->tossAll();

            $numberArray = $diceGame->getAllDices();
            $graphicsArray = $diceGame->getAllDicesGraphic();
            $totalSum = $diceGame->getSumHand();

            $_SESSION["sum"] = $totalSum + ($_SESSION["sum"] ?? 0);

            $data["totalSum"] = $totalSum;
            $data["firstToss"] = $diceGame->getSumHand();
            $data["alldices"] = $graphicsArray;
        } else {
            $_SESSION["computerSum"] = ($_SESSION["computerSum"] ?? 0);
            while ($_SESSION["computerSum"] <= $_SESSION["sum"]) {
                $diceGame = new DiceHand($_SESSION["amount"]);

                $diceGame->tossAll();
                $numberArray = $diceGame->getAllDices();
                $totalSum = $diceGame->getSumHand();

                $_SESSION["computerSum"] = $totalSum + ($_SESSION["computerSum"] ?? 0);
            }
        }
        $body = renderView("layout/dice.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function restart(): ResponseInterface
    {
        $_SESSION["sum"] = 0;
        $_SESSION["computerSum"] = 0;
        $_SESSION["stopGame"] = "not";

        $psr17Factory = new Psr17Factory();
        $_SESSION["stopGame"] = $_SESSION["stopGame"] ?? "not";
        if (isset($_POST["stop"])) {
            $_SESSION["stopGame"] = "stop";
        } elseif (isset($_POST["dices"])) {
            $_SESSION["amount"] = intval($_POST["dices"]);
        }
        $data = [
            "header" => "Dice game",
            "message" => "This is the dice game 21!",
        ];
        if ($_SESSION["stopGame"] != "stop") {
            $diceGame = new DiceHand($_SESSION["amount"]);

            $diceGame->tossAll();

            $numberArray = $diceGame->getAllDices();
            $graphicsArray = $diceGame->getAllDicesGraphic();
            $totalSum = $diceGame->getSumHand();

            $_SESSION["sum"] = $totalSum + ($_SESSION["sum"] ?? 0);

            $data["totalSum"] = $totalSum;
            $data["firstToss"] = $diceGame->getSumHand();
            $data["alldices"] = $graphicsArray;
        } else {
            $_SESSION["computerSum"] = ($_SESSION["computerSum"] ?? 0);
            while ($_SESSION["computerSum"] <= $_SESSION["sum"]) {
                $diceGame = new DiceHand($_SESSION["amount"]);

                $diceGame->tossAll();
                $numberArray = $diceGame->getAllDices();
                $totalSum = $diceGame->getSumHand();

                $_SESSION["computerSum"] = $totalSum + ($_SESSION["computerSum"] ?? 0);
            }
        }
        $body = renderView("layout/dice.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
