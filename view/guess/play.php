<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess my number!</h1>

<!-- <h1>Guess my number</h1> -->


<p>Guess a number between 1 and 100. You have <?= $tries ?> tries left.</p>





<form method="post">
    <input type="number" name="guess">

    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start over">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?= $result ?>
