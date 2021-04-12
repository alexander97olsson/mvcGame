<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use alos17\Dice\DiceHand;
use alos17\Yatzy\Yatzy;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class YatzyGame
{
    public function showStartGame(): ResponseInterface
    {
        destroySession();
        $psr17Factory = new Psr17Factory();
        $data = [
            "header" => "Yatzy game",
            "action" => url("/yatzyGame/showGame"),
            "message" => "This is the game Yatzy!",
        ];
        $body = renderView("layout/yatzystart.php", $data);

        return $psr17Factory
        ->createResponse(200)
        ->withBody($psr17Factory->createStream($body));
    }

    public function showGame(): ResponseInterface
    {
        if (!isset($_SESSION["yatzyGame"])) {
            $_SESSION["yatzyGame"] = serialize(new Yatzy());
        }
        $game = unserialize($_SESSION["yatzyGame"]);
        $game->showGame();
        $psr17Factory = new Psr17Factory();
        $data = [
            "header" => "Yatzy game",
            "message" => "This is the game Yatzy!",
        ];

        $data["totalSum"] = $_SESSION["totalSum"];
        $data["firstToss"] = $_SESSION["firstToss"];
        $data["alldices"] = $_SESSION["alldices"];
        $data["text"] = $_SESSION["text"];

        $body = renderView("layout/yatzy.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
