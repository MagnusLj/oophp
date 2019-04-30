<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Kasta gris!</h1>

<!-- <h1>Guess my number</h1> -->


<p>Första kastet: <?= $c_name ?> fick <?= $c_value ?> poäng. <?= $h_name ?> fick <?= $h_value ?> poäng. <?= $firstWin ?> får börja.</p>





<form method="post">
    <input type="submit" name="continue1" value="Fortsätt">
</form>
