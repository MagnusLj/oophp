<?php
/**
 * Provoke an exception to try out the exception handler.
 */
include(__DIR__ . "/autoload.php");
include(__DIR__ . "/config.php");

$guess = $_POST["guess"] ?? null;


if (!isset($guessobj)) {
    $guessobj = new Guess();
    $guessobj->number = $guessobj->random();
    $number = $guessobj->number;
}

$number = $guessobj->getNumber();

if (isset($_SESSION['guessobj'])) {
        $guessobj = $_SESSION['guessobj'];
}

if (isset($_SESSION['cheat'])) {
    if ($_SESSION['cheat'] === 'yes') {
        echo "<p>\n</p>";
        echo "CHEATER! The previously secret number is " . $guessobj->number;
        $_SESSION['cheat'] = 'no';
    }
}

if (isset($_SESSION['guess'])) {
        $guess = $_SESSION['guess'];
        $guessobj->makeGuess($guess);
}

$tries = $guessobj->getTries();


if (!isset($_SESSION['guessobj'])) {
    $_SESSION["guessobj"] = $guessobj;
}


//Render page
require __DIR__ . "/view/guess_my_number.php";
