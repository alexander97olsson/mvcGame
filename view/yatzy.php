<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$urlDice = url("/yatzyGame/showGame");

$_SESSION["counter"] = $_SESSION["counter"] ?? null;
$_SESSION["score"] = $_SESSION["score"] ?? 0;
$_SESSION["round"] = $_SESSION["round"] ?? 1;
$header = $header ?? null;
$message = $message ?? null;
$text = $text ?? null;
?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<?php if ($_SESSION["round"] < 7) : ?>
    <p><?= "Total score: " . $_SESSION["score"] ?></p>
    <p><?= "You have to save: " . $_SESSION["round"] . "s"?></p>
    <p class="dice-utf8">
        <?php foreach ($alldices as $value) : ?>
            <i class="<?= $value ?>"></i>
        <?php endforeach; ?>
    </p>
    <?php if ($_SESSION["counter"] != 6) : ?>
        <form action="<?= $urlDice ?>" method="post">
            <input type="checkbox" name="dicesArray[]" value="0" />1
            <input type="checkbox" name="dicesArray[]" value="1" />2
            <input type="checkbox" name="dicesArray[]" value="2" />3
            <input type="checkbox" name="dicesArray[]" value="3" />4
            <input type="checkbox" name="dicesArray[]" value="4" />5<br />
            <label>Choose dices to toss again!</label><br /><br />
            <input name="Toss" type="submit" value="Toss">
        </form>
    <?php endif; ?>
<?php else : ?>
    <p>Game is over!</p>
    <p><?= "Total score: " . $_SESSION["score"] ?></p>
<?php endif; ?>
