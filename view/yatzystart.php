<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;
$restartUrl = url("/yatzyGame/destroy");
$action = $action ?? null;

$header = $header ?? null;
$message = $message ?? null;
?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form action="<?= $action ?>" method="post">
    <input type="submit" value="Start game">
</form>
