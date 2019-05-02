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

    // $pigHandler->computerRoll($computer);

    $app->page->add("pig/play", $data);
    // $app->page->add("pig/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});






$app->router->post("pig/play", function () use ($app) {
    /**
     * Redirect after initial throw.
     */


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

    $pigHandler->computerRoll($computer);

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

    $winner = $pigHandler->isWinner2($human, $computer);

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
        "diceSumC" => $diceSumC,
        "winner" => $winner

        // "result" => $result ?? null
    ];


    // $winner = $pigHandler->isWinner2($human, $computer);

    if ($totalScoreH >= 100) {
        return $app->response->redirect("pig/game_over");
    } elseif ($totalScoreC >= 100) {
        return $app->response->redirect("pig/game_over");
    } else {
        $app->page->add("pig/play2", $data);

        $app->page->add($bottom);

        // $app->page->add("pig/play");
        // $app->page->add("guess/debug");

        return $app->page->render([
            "title" => $title,
        ]);
    }
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
    } elseif ($_POST["newRoll"] ?? false) {
        $pigHandler->mainRoll2($human, $computer);
        if (isset($_SESSION['computer'])) {
            $_SESSION["computer"] = $computer;
        }

        if (!isset($_SESSION['human'])) {
            $_SESSION["human"] = $human;
        }
        // $pigHandler->mainRoll($human, $computer);
        return $app->response->redirect("pig/play2");
    } elseif ($_POST["stop"] ?? false) {
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
    } elseif ($_POST["continue3"] ?? false) {
        return $app->response->redirect("pig/init");
        // $guessobj = $_SESSION['guessobj'];
        // $guessobj->gozer();
    }

    // return $app->response->redirect("pig/play2");
});


$app->router->get("pig/game_over", function () use ($app) {

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

    $winner = $pigHandler->isWinner2($human, $computer);

    $data = [
        "winner" => $winner
    ];

    $app->page->add("pig/game_over", $data);

    // $app->page->add($bottom);

    // $app->page->add("pig/play");
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("pig/game_over", function () use ($app) {
    // if ($_POST["continue3"] ?? false) {
        return $app->response->redirect("pig/init");
// }
});
