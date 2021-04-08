<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$urlDice = url("/dice");
$urlRestart = url("/restart");

$header = $header ?? null;
$message = $message ?? null;
$_SESSION["ownRundor"] = $_SESSION["ownRundor"] ?? 0;
$_SESSION["computerRundor"] = $_SESSION["computerRundor"] ?? 0;
?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<?php if ($_SESSION["stopGame"] != "stop") : ?>
    <?php if (intval($_SESSION["sum"]) < 21) : ?>
        <p class="dice-utf8">
        <?php foreach ($alldices as $value) : ?>
            <i class="<?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
        <p>Total sum: <?= $_SESSION["sum"] ?></p>

        <form action="<?= $urlDice ?>" method="post">
            <input name="stop" type="submit" value="Stop">
        </form>
        <form action="<?= $urlDice ?>" method="post">
            <input type="submit" value="New toss">
        </form>

    <?php elseif (intval($_SESSION["sum"]) == 21) :
        $_SESSION["ownRundor"] = 1 + $_SESSION["ownRundor"]?>
        <p><a>21, You won!</a></p>
    <?php else :
        $_SESSION["computerRundor"] = 1 + $_SESSION["computerRundor"]?>
        <p>Total sum: <?= $_SESSION["sum"] ?></p>
        <p><a>You lost!</a></p>
    <?php endif; ?>
<?php else : ?>
    <p>Your sum: <?= $_SESSION["sum"] ?></p>
    <p>Computer sum:<?= $_SESSION["computerSum"] ?></p>
    <?php if ($_SESSION["computerSum"] > 21) :
        $_SESSION["ownRundor"] = 1 + $_SESSION["ownRundor"]?>
        <p>Your won!</p>
    <?php elseif ($_SESSION["computerSum"] == 21 || $_SESSION["computerSum"] > $_SESSION["sum"]) :
        $_SESSION["computerRundor"] = 1 + $_SESSION["computerRundor"] ?>
        <p>Computer wins!</p>
    <?php else :
        $_SESSION["ownRundor"] = 1 + $_SESSION["ownRundor"]?>
        <p>You won!</p>
    <?php endif; ?>
<?php endif; ?>
<form action="<?= $urlRestart ?>" method="post">
    <input name="restart" type="submit" value="Restart">
</form>
<h3>Rundor</h3>
<p>Your wins: <?= $_SESSION["ownRundor"] ?></p>
<p>Computer wins: <?= $_SESSION["computerRundor"] ?></p>
