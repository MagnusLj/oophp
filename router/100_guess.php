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
    $guessobj->gozer();

    return $app->response->redirect("guess/play");
});



/**
 * Play game.
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
            $guessobj->cheat = "yes";
            // echo "<p>\n</p>";
            // echo "CHEATER! The previously secret number is " . $guessobj->number;
            // $_SESSION['cheat'] = 'no';
        }
    }

    // var_dump($guessobj);

    if (isset($_SESSION['guess'])) {
            $guess = $_SESSION['guess'];
            $guessobj->makeGuess($guess);
    }

    $tries = $guessobj->getTries();

    if (isset($_SESSION['result'])) {
            $result = $_SESSION['result'];
    }


    if ($tries == 0) {
        return $app->response->redirect("guess/game_over");
    }



    if (isset($_SESSION['guess'])) {
        if ($guess === $guessobj->number) {
                return $app->response->redirect("guess/game_over");
        }
    }




    if (!isset($_SESSION['guessobj'])) {
        $_SESSION["guessobj"] = $guessobj;
    }

    $data = [
        "guess" => $guess,
        "tries" => $tries,
        "result" => $result ?? null
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Render game over page
 */
$app->router->get("guess/game_over", function () use ($app) {
    // Game over page
    $title = "Play game";

    $app->page->add("guess/game_over");
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Redirect from game over page
 */
$app->router->post("guess/game_over", function () use ($app) {
    // Init session for game start

    // $app->page->add("guess/game_over");
    // $app->page->add("guess/debug");

    // return $app->page->render([
    //     "title" => $title,
    // ]);
    return $app->response->redirect("guess/init");
});



$app->router->post("guess/play", function () use ($app) {
    /**
     * Redirect on cheat.
     */

    if ($_POST["doCheat"] ?? false) {
        $_SESSION['cheat'] = 'yes';
        $guessobj = $_SESSION['guessobj'];
        $number = $guessobj->number;
        $_SESSION['result'] = "<h2>Cheater! The correct number is $number</h2>";
        $_SESSION['cheat'] = 'no';
        // echo $_SESSION['cheat'];
    }

    return $app->response->redirect("guess/play");
});



$app->router->post("guess/play", function () use ($app) {

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

// if ($_POST["doCheat"] ?? false) {
//     $_SESSION['cheat'] = 'yes';
//     // echo $_SESSION['cheat'];
// }

/**
 * Redirect on restart.
 */

if ($_POST["doInit"] ?? false) {
    $guessobj = $_SESSION['guessobj'];
    $guessobj->gozer();
}


$title = "Play game";


/**
 * Guess
 */
if ($_POST["doGuess"] ?? false) {
    $_SESSION['guess'] = intval($_POST["guess"]);
    $guessobj = $_SESSION['guessobj'];
    $tries = $guessobj->tries;
}
