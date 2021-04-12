<?php

declare(strict_types=1);

namespace alos17\Yatzy;
use alos17\Dice\DiceHand;

class Yatzy
{
    public function showGame()
    {
        if (!isset($_SESSION["yatzyObjekt"])) {
            $_SESSION["yatzyObjekt"] = serialize(new DiceHand(5));
        }
        $_SESSION["totalSum"] = $_SESSION["totalSum"] ?? null;
        $_SESSION["firstToss"] = $_SESSION["firstToss"] ?? null;
        $_SESSION["alldices"] = $_SESSION["alldices"] ?? null;
        $_SESSION["text"] = $_SESSION["text"] ?? null;
        $_SESSION["counter"] = $_SESSION["counter"] ?? null;
        $_SESSION["gameState"] = $_SESSION["gameState"] ?? 1;
        $_SESSION["score"] = $_SESSION["score"] ?? null;

        $diceObject = unserialize($_SESSION["yatzyObjekt"]);
        if (isset($_POST["Toss"])) {
            $dicesArray = $_POST['dicesArray'];
            $diceObject->setAllDices($_SESSION["numberOfValues"]);
            for ($i=0; $i < count($dicesArray); $i++) { 
                $diceObject->tossSpecific(intval($dicesArray[$i]));
            }
            $_SESSION["counter"] = $_SESSION["counter"] + 1;
            
        } else {
            $diceObject->tossAll();
        }
        $diceObject->getallNumberzs();
        
        $numberArray = $diceObject->getAllDices();
        $graphicsArray = $diceObject->getAllDicesGraphic();
        $totalSum = $diceObject->getSumHand();
        
        $_SESSION["totalSum"] = $totalSum;
        $_SESSION["firstToss"] = $diceObject->getSumHand();
        $_SESSION["alldices"] = $graphicsArray;
        $_SESSION["text"] = $numberArray;
        $_SESSION["numberOfValues"] = $numberArray;
        if ($_SESSION["counter"] == 3) {
            $_SESSION["round"] = $_SESSION["round"] + 1;
            if ($_SESSION["round"] == 7 && $_SESSION["score"] >= 63) {
                $this->calcScore(50);
            }
            $this->calcScore($this->getAllScores($_SESSION["gameState"]));
        }
    }

    public function getAllScores(int $number)
    {
        $diceObject = unserialize($_SESSION["yatzyObjekt"]);
        $amount = 0;
        $numberArray = $_SESSION["numberOfValues"];
        for ($i=0; $i < count($numberArray); $i++) { 
            if ($numberArray[$i] == $number) {
                $amount = $amount + 1;
            }
        }
        $_SESSION["counter"] = 0;
        $_SESSION["gameState"] = $_SESSION["gameState"] + 1;
        return $amount * $number;
    }

    public function calcScore(int $number)
    {
        $_SESSION["score"] = $_SESSION["score"] + $number;
    }
}
