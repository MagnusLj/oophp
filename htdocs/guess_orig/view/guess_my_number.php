<?php

include(__DIR__ . "../../autoload.php");
include(__DIR__ . "../../config.php");

?>

<h1>Guess my number</h1>


<p>Guess a number between 1 and 100. You have <?= $tries ?> tries left.</p>




<form method="post" action="../guess/redirect.php">
    <input type="number" name="guess">

    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start over">
    <input type="submit" name="doCheat" value="Cheat">
</form>
