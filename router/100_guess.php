<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Initiate the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // Init session for game start

    $guessobj = new Malm18\Guess\Guess();

    return $app->response->redirect("guess/play");
});



/**
 * Returning a JSON message with Hello World.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play game";


    //Deal with incoming variables
    $guess = $_POST["guess"] ?? null;


    if (!isset($guessobj)) {
        $guessobj = new Malm18\Guess\Guess();
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
            // $_SESSION['cheat'] = 'no';
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

    $data = [
        "guess" => $guess,
        "tries" => $tries
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Returning a JSON message with Hello World.
 */
$app->router->post("guess/redirect", function () use ($app) {
    $title = "Play game";
    //
    // if ($_POST["doGuess"] ?? false) {
    //     $_SESSION['guess'] = intval($_POST["guess"]);
    //     $guessobj = $_SESSION['guessobj'];
    //     $tries = $guessobj->tries;
    // }

    if ($_POST["doCheat"] ?? false) {
        $_SESSION['cheat'] = 'yes';
        // echo $_SESSION['cheat'];
    }

return $app->response->redirect("guess/play");

});




$app->router->post("guess/play", function () use ($app) {
    /**
     * Redirect on cheat.
     */

    if ($_POST["doCheat"] ?? false) {
        $_SESSION['cheat'] = 'yes';
        // echo $_SESSION['cheat'];
    }

return $app->response->redirect("guess/play");

});



$app->router->post("guess/redirect", function () use ($app) {

    /**
     * Redirect on restart.
     */

    if ($_POST["doInit"] ?? false) {
        $guessobj = $_SESSION['guessobj'];
        $guessobj->gozer();
    }

return $app->response->redirect("guess/play");

});


/**
 * Redirect on cheat.
 */

if ($_POST["doCheat"] ?? false) {
    $_SESSION['cheat'] = 'yes';
    // echo $_SESSION['cheat'];
}

/**
 * Redirect on restart.
 */

if ($_POST["doInit"] ?? false) {
    $guessobj = $_SESSION['guessobj'];
    $guessobj->gozer();
}


$title = "Play game";

if ($_POST["doGuess"] ?? false) {
    $_SESSION['guess'] = intval($_POST["guess"]);
    $guessobj = $_SESSION['guessobj'];
    $tries = $guessobj->tries;
}
