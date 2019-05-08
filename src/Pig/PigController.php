<?php

namespace Malm18\Pig;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PigController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    // public function debugAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "Indexx";
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // Init session for game start

        $pigobj = new Pig();

        $pigobj->gozer();

        return $this->app->response->redirect("pig1/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {




        $title = "Spela kasta gris (Controller)";


        //Deal with incoming variables
        // $pigobj = $_POST["pigobj"] ?? null;
        $computer = $_POST["computer"] ?? null;
        $human = $_POST["human"] ?? null;

        if (!isset($computer)) {
            $computer = new Pig();
            $computer->setName("Datorn");
            // $guessobj->number = $guessobj->random();
            $c_value = $computer->value();
            $c_name = $computer->getName();
        }

        if (!isset($human)) {
            $human = new Pig();
            $human->setName("Människan");
            // $guessobj->number = $guessobj->random();
            $h_value = $human->value();
            $h_name = $human->getName();
        }

        if (!isset($active)) {
            $pigHandler = new PigHandler();
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

        $this->app->page->add("pig1/play", $data);
        $this->app->page->add("pig1/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() //: object
    {
        /**
         * Redirect after initial throw.
         */


        return $this->app->response->redirect("pig1/play2");
    }








    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function play2ActionGet() //: object
    {
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
            return $this->app->response->redirect("pig/game_over");
        } elseif ($totalScoreC >= 100) {
            return $this->app->response->redirect("pig/game_over");
        } else {
            $this->app->page->add("pig/play2", $data);

            $this->app->page->add($bottom);

            // $app->page->add("pig/play");
            // $app->page->add("guess/debug");

            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function play2ActionPost() : object
    {
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

            return $this->app->response->redirect("pig1/play2");
        } elseif ($_POST["newRoll"] ?? false) {
            $pigHandler->mainRoll2($human, $computer);
            if (isset($_SESSION['computer'])) {
                $_SESSION["computer"] = $computer;
            }

            if (!isset($_SESSION['human'])) {
                $_SESSION["human"] = $human;
            }
            // $pigHandler->mainRoll($human, $computer);
            return $this->app->response->redirect("pig1/play2");
        } elseif ($_POST["stop"] ?? false) {
            $pigHandler->mainRoll($human, $computer);
            if (isset($_SESSION['computer'])) {
                $_SESSION["computer"] = $computer;
            }

            if (!isset($_SESSION['human'])) {
                $_SESSION["human"] = $human;
            }
            return $this->app->response->redirect("pig1/play2");
            // $guessobj = $_SESSION['guessobj'];
            // $guessobj->gozer();
        } elseif ($_POST["continue3"] ?? false) {
            return $this->app->response->redirect("pig1/init");
            // $guessobj = $_SESSION['guessobj'];
            // $guessobj->gozer();
        }

        // return $app->response->redirect("pig/play2");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function game_overActionGet() : object
    {
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

        $this->app->page->add("pig1/game_over", $data);

        // $app->page->add($bottom);

        // $app->page->add("pig/play");
        // $app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function game_overActionPost() : object
    {
        return $this->app->response->redirect("pig1/init");
    }






    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    // public function debugAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "Debug my pig";
    }

}

//     /**
//      * This sample method dumps the content of $app.
//      * GET mountpoint/dump-app
//      *
//      * @return string
//      */
//     public function dumpAppActionGet() : string
//     {
//         // Deal with the action and return a response.
//         $services = implode(", ", $this->app->getServices());
//         return __METHOD__ . "<p>\$app contains: $services";
//     }
//
//
//
//     /**
//      * Add the request method to the method name to limit what request methods
//      * the handler supports.
//      * GET mountpoint/info
//      *
//      * @return string
//      */
//     public function infoActionGet() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action it the handler for route:
//      * GET mountpoint/create
//      *
//      * @return string
//      */
//     public function createActionGet() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action it the handler for route:
//      * POST mountpoint/create
//      *
//      * @return string
//      */
//     public function createActionPost() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action takes one argument:
//      * GET mountpoint/argument/<value>
//      *
//      * @param mixed $value
//      *
//      * @return string
//      */
//     public function argumentActionGet($value) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
//     }
//
//
//
//     /**
//      * This sample method action takes zero or one argument and you can use - as a separator which will then be removed:
//      * GET mountpoint/defaultargument/
//      * GET mountpoint/defaultargument/<value>
//      * GET mountpoint/default-argument/
//      * GET mountpoint/default-argument/<value>
//      *
//      * @param mixed $value with a default string.
//      *
//      * @return string
//      */
//     public function defaultArgumentActionGet($value = "default") : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
//     }
//
//
//
//     /**
//      * This sample method action takes two typed arguments:
//      * GET mountpoint/typed-argument/<string>/<int>
//      *
//      * NOTE. Its recommended to not use int as type since it will still
//      * accept numbers such as 2hundred givving a PHP NOTICE. So, its better to
//      * deal with type check within the action method and throuw exceptions
//      * when the expected type is not met.
//      *
//      * @param mixed $value with a default string.
//      *
//      * @return string
//      */
//     public function typedArgumentActionGet(string $str, int $int) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got string argument '$str' and int argument '$int'.";
//     }
//
//
//
//     /**
//      * This sample method action takes a variadic list of arguments:
//      * GET mountpoint/variadic/
//      * GET mountpoint/variadic/<value>
//      * GET mountpoint/variadic/<value>/<value>
//      * GET mountpoint/variadic/<value>/<value>/<value>
//      * etc.
//      *
//      * @param array $value as a variadic parameter.
//      *
//      * @return string
//      */
//     public function variadicActionGet(...$value) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got '" . count($value) . "' arguments: " . implode(", ", $value);
//     }
//
//
//
//     /**
//      * Adding an optional catchAll() method will catch all actions sent to the
//      * router. You can then reply with an actual response or return void to
//      * allow for the router to move on to next handler.
//      * A catchAll() handles the following, if a specific action method is not
//      * created:
//      * ANY METHOD mountpoint/**
//      *
//      * @param array $args as a variadic parameter.
//      *
//      * @return mixed
//      *
//      * @SuppressWarnings(PHPMD.UnusedFormalParameter)
//      */
//     public function catchAll(...$args)
//     {
//         // Deal with the request and send an actual response, or not.
//         //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
//         return;
//     }
// }
