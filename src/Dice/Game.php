<?php

declare(strict_types=1);

namespace alos17\Dice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

class Game
{
    public function startGame()
    {
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
        sendResponse($body);
    }

    public function restart()
    {
        $_SESSION["sum"] = 0;
        $_SESSION["computerSum"] = 0;
        $_SESSION["stopGame"] = "not";
    }
}
