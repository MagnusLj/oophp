<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

include(__DIR__ . "../../autoload.php");
include(__DIR__ . "../../config.php");

class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */



    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
            $this->number = $number;
            $this->tries = $tries;
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
            $number = rand(1, 100);
            return $number;
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function getTries()
    {
        return $this->tries;
    }


    /**
     * Set number of tries.
     *
     * @param int $tries New number of tries.
     *
     * @return void
     */
    public function setTries(int $tries)
    {
        $this->tries = $tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function getNumber()
    {
        return $this->number;
    }


    /**
     * Set secret number.
     *
     * @param int $number, secret number.
     *
     * @return void
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remain.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($guess)
    {

        if ($guess <= 0 || $guess > 100) {
            $this->gozer2();
            throw new GuessException("Number must be between 1 and 100.");
        }



        $tries = $this->getTries();
        $tries = $tries - 1;
        $this->setTries($tries);

        if ($guess === $this->number) {
            echo "<p>\nCorrect!\n</p>";
            $_SESSION['result'] = "<h2>Correct answer! Horray!</h2>";
            header("Location: ../guess/view/game_over.php");
        } elseif ($tries < 1) {
            $_SESSION['result'] = "<h2>No more guesses!</h2>";
            header("Location: ../guess/view/game_over.php");
        } elseif ($guess < $this->number) {
            echo "<p>\nWe too low!\n</p>";
        } else {
            echo "<p>\nWe too high!\n</p>";
        }
    }

 /**
  * Destroy the session
  *
  *
  *
  * @return void to show the status of the guess made.
  */

    public function gozer()
    {
    //    Unset all of the session variables.
          $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

          // Finally, destroy the session.
          session_destroy();
          echo "The session is destroyed.";
          header("Location: ../guess/index.php");
    }

      /**
       * Destroy the session
       *
       *
       *
       * @return void to show the status of the guess made.
       */

    public function gozer2()
    {
        //    Unset all of the session variables.
        $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
        echo "The session is destroyed.";
    }
}
