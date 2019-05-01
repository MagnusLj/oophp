<?php

namespace Malm18\Pig;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

// include(__DIR__ . "../../autoload.php");
// include(__DIR__ . "../../config.php");

class Pig
{
    /**
 * A dicehand, consisting of dice.
 */
    /**
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $value;
     // public $value;

     /**
     * @var int $lastRoll  Value of the last roll.
     */
    private $lastRoll;

    /**
    * @var string $lastRoll  Value of the last roll.
    */
   private $name;

   /**
   * @var bool $lastRoll  Value of the last roll.
   */
  private $active;



  /**
  * @var int $die1, die1 value.
  */
 private $die1;

 /**
 * @var int $die2, die1 value.
 */
private $die2;

/**
* @var int $rolls  Number of rolls.
*/
private $rolls;

/**
* @var int $turnScore Curernt score
*/
private $turnScore;

/**
* @var int $totalScore. Total score
*/
private $totalScore;


    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct()
    {
        $this->value = rand(1, 6);

        $this->sides = 6;

        $this->active = false;

        $this->die1 = null;

        $this->die2 = null;

        $this->rolls = 0;

        $this->turnScore = 0;

        $this->totalScore = 0;
    }


    /**
     * getDie1
     * @return int , return die1 value
     */

    public function getDie1()
    {
        return $this->die1;
    }

    /**
     * getDie2
     * @return int , return die2 value
     */

    public function getDie2()
    {
        return $this->die2;
    }

    /**
     * setDie1
     * @return void
     */
    public function setDie1($die1)
    {
        $this->die1 = $die1;
    }

    /**
     * setDie2
     * @return void
     */
    public function setDie2($die2)
    {
        $this->die2 = $die2;
    }

    /**
     * getDiceSum
     * @return int , return sum of both dice
     */

    public function getDiceSum()
    {
        $diceSum = $this->die1 + $this->die2;
        return $diceSum;
    }

    /**
     * getRolls
     * @return int , return amount of rolls
     */

    public function getRolls()
    {
        return $this->rolls;
    }

    public function setRolls($rolls)
    {
        $this->rolls = $rolls;
    }

    /**
     * getTurnScore
     * @return int , return score for this turn
     */

    public function getTurnScore()
    {
        return $this->turnScore;
    }

    public function setTurnScore($score)
    {
        $this->turnScore = $score;
    }

    /**
     * getTotalScore
     * @return int , return total score
     */

    public function getTotalScore()
    {
        return $this->totalScore;
    }


    public function setTotalScore($score)
    {
        $this->totalScore = $score;
    }


    /**
     * Set names
     * @return void , set names
     */

    public function setName($name)
    {
        $this->name = $name;
    }



    /**
     * REturn names
     * @return string , return names
     */

    public function getName()
    {
        return $this->name;
    }


    /**
     *
     * @return void , set active status
     */

    public function setActive($aBoolean)
    {
        $this->active = $aBoolean;
    }


    /**
     *
     * @return string , get active status
     */

    public function getActive()
    {
        return $this->active;
    }




    /**
     * Roll all dices save their value.
     *
     * @@return int
     */
    public function roll()
    {
        // for ($i = 0; $i < 6; $i++) {
        //     $a_roll = rand(1, 6);
        //     array_push($this->values, $a_roll);
        // }
        // // print_r($this->values);
        // return $this->values;
        $aRoll = rand(1, 6);
        $this->value = $aRoll;
        $this->lastRoll = $aRoll;
    }

    /**
     * Roll all dices save their value.
     *
     * @@return int
     */
    public function roll2()
    {
        // for ($i = 0; $i < 6; $i++) {
        //     $a_roll = rand(1, 6);
        //     array_push($this->values, $a_roll);
        // }
        // // print_r($this->values);
        // return $this->values;
        $aRoll = rand(1, 6);
        $bRoll = rand(1, 6);
        $this->die1 = $aRoll;
        $this->die2 = $bRoll;
    }

    /**
     * RollOrNot
     *
     * @@return int, how computer decides to roll or not
     */
    public function rollOrNot()
    {
        // for ($i = 0; $i < 6; $i++) {
        //     $a_roll = rand(1, 6);
        //     array_push($this->values, $a_roll);
        // }
        // // print_r($this->values);
        // return $this->values;
        $aRoll = rand(1, 2);
        return $aRoll;
    }


    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    /**
     * Get values of dices from last roll.
     *
     * @return int with values of the last roll.
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        $sum = array_sum($this->values);
        return $sum;
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $average = $this->sum() / count($this->values);
        return $average;
    }

    /**
     * Destroy the session
     *
     *
     *
     * @return void , destroy session
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
