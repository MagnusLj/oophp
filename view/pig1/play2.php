<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Kasta gris!</h1>

<!-- <h1>Guess my number</h1> -->

<h3><?= $active ?>s runda</h3>

<table>
    <tr>
        <td></td><td>Människan</td><td>Datorn</td>
    </tr>
    <tr>
        <td>Total poäng</td><td><?= $totalScoreH ?></td><td><?= $totalScoreC ?></td>
    </tr>
    <!-- <tr>
        <td></td><td></td><td></td>
    </tr> -->
    <tr>
        <td>Aktuell poäng</td><td><?= $turnScoreH ?></td><td><?= $turnScoreC ?></td>
    </tr>
    <!-- <tr>
        <td></td><td></td><td></td>
    </tr> -->
    <tr>
        <td>Tärning 1</td><td><?= $die1H ?></td><td><?= $die1C ?></td>
    </tr>
    <tr>
        <td>Tärning 2</td><td><?= $die2H ?></td><td><?= $die2C ?></td>
    </tr>
    <tr>
        <td>Summa</td><td><?= $diceSumH ?></td><td><?= $diceSumC ?></td>
    </tr>
    <!-- <tr>
        <td></td><td></td><td></td>
    </tr> -->
    <tr>
        <td>Antal kast</td><td><?= $rollsH ?></td><td><?= $rollsC ?></td>
    </tr>
</table>

<!-- <form method="post">
    <input type="submit" name="continue1" value="Fortsätt">
</form> -->
