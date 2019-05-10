<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Kasta gris (Controller)!</h1>

<!-- <h1>Guess my number</h1> -->

<h3><?= $active ?>s runda</h3>

<!-- <h1>Display a histogram</h1> -->
<div class="humandiv">
<p>Människans kast</p>
<pre><?= $histogramH->getAsText() ?></pre>
</div>

<div class="computerdiv">
<p>Datorns kast</p>
<pre><?= $histogramC->getAsText() ?></pre>
</div>

<table class="pigtable">
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
