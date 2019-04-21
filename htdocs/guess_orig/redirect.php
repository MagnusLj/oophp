<?php

include(__DIR__ . "/autoload.php");
include(__DIR__ . "/config.php");


/**
 * A processing page that redirects.
 */


 /**
  * Redirect on guess.
  */

if ($_POST["doGuess"] ?? false) {
    $_SESSION['guess'] = intval($_POST["guess"]);
    $guessobj = $_SESSION['guessobj'];
    $tries = $guessobj->tries;
    header("Location: ../guess/index.php");
}


/**
 * Redirect on restart.
 */

if ($_POST["doInit"] ?? false) {
    $guessobj = $_SESSION['guessobj'];
    $guessobj->gozer();
}


/**
 * Redirect on cheat.
 */

if ($_POST["doCheat"] ?? false) {
    $_SESSION['cheat'] = 'yes';
    // echo $_SESSION['cheat'];
    header("Location: ../guess/index.php");
}
