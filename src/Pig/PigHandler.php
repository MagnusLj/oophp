<?php

namespace Malm18\Pig;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

// include(__DIR__ . "../../autoload.php");
// include(__DIR__ . "../../config.php");

class PigHandler
{


       /**
        * Check first win.
        *
        * @return variable , variable
        */
       public function active($computer, $human)
       {
           if ($computer->value() > $human->value()) {
               $computer->setActive();
               return $computer->getName();
           }
           $human->setActive();
           return $human->getName();
       }


       /**
        * Check first win in another way.
        *
        * @return variable , variable
        */
       public function getActive($computer, $human)
       {
           if ($computer->getActive() == true) {
               return $computer->getName();
           }
           return $human->getName();
       }



}







 //    /**
 //     * @var int $number   The current secret number.
 //     * @var int $tries    Number of tries a guess has been made.
 //     */
 //
 //
 //
 //    /**
 //     * Constructor to initiate the object with current game settings,
 //     * if available. Randomize the current number if no value is sent in.
 //     *
 //     * @param int $number The current secret number, default -1 to initiate
 //     *                    the number from start.
 //     * @param int $tries  Number of tries a guess has been made,
 //     *                    default 6.
 //     */
 //
 //    public function __construct(int $number = -1, int $tries = 6, string $cheat = "no")
 //    {
 //            $this->number = $number;
 //            $this->tries = $tries;
 //            $this->cheat = $cheat;
 //    }
 //
 //
 //
 //    /**
 //     * Randomize the secret number between 1 and 100 to initiate a new game.
 //     *
 //     * @return int , random number.
 //     */
 //
 //    public function random()
 //    {
 //            $number = rand(1, 100);
 //            return $number;
 //    }
 //
 //
 //
 //
 //    /**
 //     * Get number of tries left.
 //     *
 //     * @return int as number of tries made.
 //     */
 //
 //    public function getTries()
 //    {
 //        return $this->tries;
 //    }
 //
 //
 //    /**
 //     * Set number of tries.
 //     *
 //     * @param int $tries New number of tries.
 //     *
 //     * @return void
 //     */
 //    public function setTries(int $tries)
 //    {
 //        $this->tries = $tries;
 //    }
 //
 //
 //    /**
 //     * Get the secret number.
 //     *
 //     * @return int as the secret number.
 //     */
 //
 //    public function getNumber()
 //    {
 //        return $this->number;
 //    }
 //
 //
 //    /**
 //     * Set secret number.
 //     *
 //     * @param int $number, secret number.
 //     *
 //     * @return void
 //     */
 //    public function setNumber(int $number)
 //    {
 //        $this->number = $number;
 //    }
 //
 //
 //
 //
 //    /**
 //     * Make a guess, decrease remaining guesses and return a string stating
 //     * if the guess was correct, too low or to high or if no guesses remain.
 //     *
 //     * @throws GuessException when guessed number is out of bounds.
 //     *
 //     * @return string to show the status of the guess made.
 //     */
 //
 //    public function makeGuess($guess)
 //    {
 //
 //        if ($guess <= 0 || $guess > 100) {
 //            $this->gozer2();
 //            throw new GuessException("Number must be between 1 and 100.");
 //        }
 //
 //
 //
 //        $tries = $this->getTries();
 //        $tries = $tries - 1;
 //        $this->setTries($tries);
 //
 //        if ($guess === $this->number) {
 //            echo "<p>\nCorrect!\n</p>";
 //            $_SESSION['result'] = "<h2>Correct answer! Horray!</h2>";
 //            header("Location: ../guess/game_over");
 //        } elseif ($this->cheat == "yes") {
 //            $_SESSION['result'] = "<h2>Cheater! The correct number is $this->number</h2>";
 //            $this->cheat = "no";
 //        } elseif ($tries < 1) {
 //            $_SESSION['result'] = "<h2>No more guesses!</h2>";
 //            // header("Location: ../guess/view/game_over.php");
 //        } elseif ($guess < $this->number) {
 //            $_SESSION['result'] = "<h2>We too low!</h2>";
 //            // echo "<p>\nWe too low!\n</p>";
 //        } elseif ($guess > $this->number) {
 //            $_SESSION['result'] = "<h2>We too high!</h2>";
 //        }
 //    }
 //
 // /**
 //  * Destroy the session
 //  *
 //  *
 //  *
 //  * @return void , destroy session
 //  */
 //
 //    public function gozer()
 //    {
 //    //    Unset all of the session variables.
 //          $_SESSION = [];
 //
 //        // If it's desired to kill the session, also delete the session cookie.
 //        // Note: This will destroy the session, and not just the session data!
 //        if (ini_get("session.use_cookies")) {
 //            $params = session_get_cookie_params();
 //            setcookie(
 //                session_name(),
 //                '',
 //                time() - 42000,
 //                $params["path"],
 //                $params["domain"],
 //                $params["secure"],
 //                $params["httponly"]
 //            );
 //        }
 //
 //          // Finally, destroy the session.
 //          session_destroy();
 //          echo "The session is destroyed.";
 //          header("Location: ../guess/index.php");
 //    }
 //
 //      /**
 //       * Destroy the session
 //       *
 //       *
 //       *
 //       * @return void , destroy session.
 //       */
 //
 //    public function gozer2()
 //    {
 //        //    Unset all of the session variables.
 //        $_SESSION = [];
 //
 //        // If it's desired to kill the session, also delete the session cookie.
 //        // Note: This will destroy the session, and not just the session data!
 //        if (ini_get("session.use_cookies")) {
 //            $params = session_get_cookie_params();
 //            setcookie(
 //                session_name(),
 //                '',
 //                time() - 42000,
 //                $params["path"],
 //                $params["domain"],
 //                $params["secure"],
 //                $params["httponly"]
 //            );
 //        }
 //
 //        // Finally, destroy the session.
 //        session_destroy();
 //        echo "The session is destroyed.";
 //    }
// }
