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

        $this->winner = false;
    }


    /**
     * setWinner
     * @return void , setWinner
     */

    public function setWinner()
    {
        $this->winner = true;
    }

    /**
     * isWinner
     * @return bool , isWinner
     */

    public function isWinner()
    {
        return $this->winner;
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
