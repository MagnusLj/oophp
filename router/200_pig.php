<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Initiate the game and redirect to play the game
 */
$app->router->get("pig/init", function () use ($app) {
    // Init session for game start

    $pigobj = new Malm18\Pig\Pig();

    $pigobj->gozer();

    return $app->response->redirect("pig/play");
});



/**
 * Play game.
 */
$app->router->get("pig/play", function () use ($app) {
    $title = "Spela kasta gris";


    //Deal with incoming variables
    // $pigobj = $_POST["pigobj"] ?? null;
    $computer = $_POST["computer"] ?? null;
    $human = $_POST["human"] ?? null;

    if (!isset($computer)) {
        $computer = new Malm18\Pig\Pig();
        $computer->setName("Datorn");
        // $guessobj->number = $guessobj->random();
        $c_value = $computer->value();
        $c_name = $computer->getName();
    }

    if (!isset($human)) {
        $human = new Malm18\Pig\Pig();
        $human->setName("Människan");
        // $guessobj->number = $guessobj->random();
        $h_value = $human->value();
        $h_name = $human->getName();
    }

    if (!isset($active)) {
        $pigHandler = new Malm18\Pig\PigHandler();
        $active = $pigHandler->active($computer, $human);
    }

    // $number = $guessobj->getNumber();

    if (isset($_SESSION['computer'])) {
            $computer = $_SESSION['computer'];
    }

    if (isset($_SESSION['human'])) {
            $human = $_SESSION['human'];
    }



    // if (isset($_SESSION['cheat'])) {
    //     if ($_SESSION['cheat'] === 'yes') {
    //         $guessobj->cheat = "yes";
    //         // echo "<p>\n</p>";
    //         // echo "CHEATER! The previously secret number is " . $guessobj->number;
    //         // $_SESSION['cheat'] = 'no';
    //     }
    // }

    // var_dump($guessobj);

    // if (isset($_SESSION['guess'])) {
    //         $guess = $_SESSION['guess'];
    //         $guessobj->makeGuess($guess);
    // }
    //
    // $tries = $guessobj->getTries();
    //
    // if (isset($_SESSION['result'])) {
    //         $result = $_SESSION['result'];
    // }


    // if ($tries == 0) {
    //     return $app->response->redirect("guess/game_over");
    // }



    // if (isset($_SESSION['pig'])) {
    //     if ($guess === $guessobj->number) {
    //             return $app->response->redirect("guess/game_over");
    //     }
    // }




    if (!isset($_SESSION['computer'])) {
        $_SESSION["computer"] = $computer;
    }

    if (!isset($_SESSION['human'])) {
        $_SESSION["human"] = $human;
    }

    if (!isset($_SESSION['pigHandler'])) {
        $_SESSION["pigHandler"] = $pigHandler;
    }




    $data = [
        "c_name" => $c_name,
        "h_name" => $h_name,
        "c_value" => $c_value,
        "h_value" => $h_value,
        "active" => $active
        // "result" => $result ?? null
    ];

    // $pigHandler->computerRoll($human, $computer);

    $app->page->add("pig/play", $data);
    $app->page->add("pig/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Render game over page
 */
// $app->router->get("guess/game_over", function () use ($app) {
//     // Game over page
//     $title = "Play game";
//
//     $app->page->add("guess/game_over");
//     // $app->page->add("guess/debug");
//
//     return $app->page->render([
//         "title" => $title,
//     ]);
// });


// /**
//  * Redirect from game over page
//  */
// $app->router->post("guess/game_over", function () use ($app) {
//     // Init session for game start
//
//     // $app->page->add("guess/game_over");
//     // $app->page->add("guess/debug");
//
//     // return $app->page->render([
//     //     "title" => $title,
//     // ]);
//     return $app->response->redirect("guess/init");
// });



$app->router->post("pig/play", function () use ($app) {
    /**
     * Redirect after initial throw.
     */

    // if ($_POST["continue1"] ?? false) {
    //     $_SESSION['cheat'] = 'yes';
    //     $guessobj = $_SESSION['guessobj'];
    //     $number = $guessobj->number;
    //     $_SESSION['result'] = "<h2>Cheater! The correct number is $number</h2>";
    //     $_SESSION['cheat'] = 'no';
    //     // echo $_SESSION['cheat'];
    // }

    return $app->response->redirect("pig/play2");
});


$app->router->get("pig/play2", function () use ($app) {
    // Game over page
    $title = "Kasta gris";

    if (isset($_SESSION['computer'])) {
            $computer = $_SESSION['computer'];
    }

    if (isset($_SESSION['human'])) {
            $human = $_SESSION['human'];
    }

    if (isset($_SESSION['pigHandler'])) {
            $pigHandler = $_SESSION['pigHandler'];
    }

    $active = $pigHandler->getActive($computer, $human);

    $pigHandler->computerRoll($human, $computer);

    $die1H = $human->getDie1();
    $die2H = $human->getDie2();

    $die1C = $computer->getDie1();
    $die2C = $computer->getDie2();

    $rollsH = $human->getRolls();
    $rollsC = $computer->getRolls();

    $turnScoreH = $human->getTurnScore();
    $turnScoreC = $computer->getTurnScore();

    $totalScoreH = $human->getTotalScore();
    $totalScoreC = $computer->getTotalScore();

    $diceSumH = $human->getDiceSum();
    $diceSumC = $computer->getDiceSum();

    $rollsH = $human->getRolls();
    $rollsC = $computer->getRolls();

    $bottom = $pigHandler->getActive2($computer, $human);

    // print_r($active);


    $data = [
        "active" => $active,
        "die1H" => $die1H,
        "die2H" => $die2H,
        "die1C" => $die1C,
        "die2C" => $die2C,
        "rollsH" => $rollsH,
        "rollsC" => $rollsC,
        "turnScoreH" => $turnScoreH,
        "turnScoreC" => $turnScoreC,
        "totalScoreH" => $totalScoreH,
        "totalScoreC" => $totalScoreC,
        "diceSumH" => $diceSumH,
        "diceSumC" => $diceSumC

        // "result" => $result ?? null
    ];



    $app->page->add("pig/play2", $data);

    $app->page->add($bottom);

    // $app->page->add("pig/play");
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});




$app->router->post("pig/play2", function () use ($app) {
    /**
     * Redirect after computer throw.
     */

    if (isset($_SESSION['computer'])) {
        $computer = $_SESSION['computer'];
    }

    if (isset($_SESSION['human'])) {
        $human = $_SESSION['human'];
    }


    if (isset($_SESSION['pigHandler'])) {
        $pigHandler = $_SESSION['pigHandler'];
    }

    if ($_POST["continue2"] ?? false) {
        $pigHandler->mainRoll($human, $computer);
        if (isset($_SESSION['computer'])) {
            $_SESSION["computer"] = $computer;
        }

        if (!isset($_SESSION['human'])) {
            $_SESSION["human"] = $human;
        }

        return $app->response->redirect("pig/play2");
}
    elseif ($_POST["newRoll"] ?? false) {
        $pigHandler->mainRoll2($human, $computer);
        if (isset($_SESSION['computer'])) {
            $_SESSION["computer"] = $computer;
        }

        if (!isset($_SESSION['human'])) {
            $_SESSION["human"] = $human;
        }
        // $pigHandler->mainRoll($human, $computer);
        return $app->response->redirect("pig/play2");
    }

    elseif ($_POST["stop"] ?? false) {
        $pigHandler->mainRoll($human, $computer);
        if (isset($_SESSION['computer'])) {
            $_SESSION["computer"] = $computer;
        }

        if (!isset($_SESSION['human'])) {
            $_SESSION["human"] = $human;
        }
        return $app->response->redirect("pig/play2");
        // $guessobj = $_SESSION['guessobj'];
        // $guessobj->gozer();
    }

    // return $app->response->redirect("pig/play2");
});


// $app->router->post("guess/play", function () use ($app) {
//
//     /**
//      * Redirect on restart.
//      */
//
//     if ($_POST["doInit"] ?? false) {
//         $guessobj = $_SESSION['guessobj'];
//         $guessobj->gozer();
//     }
//
//     return $app->response->redirect("guess/play");
// });


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
