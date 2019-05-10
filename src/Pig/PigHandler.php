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
    * Check active.
    *
    * @return variable , variable
    */
    public function active($computer, $human)
    {
        if ($computer->value() > $human->value()) {
            $computer->setActive(true);
            return $computer->getName();
        } else {
            $human->setActive(true);
            return $human->getName();
        }
    }


    /**
    * Check active in another way.
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



    /**
    * Check active in yet another way.
    *
    * @return string , string
    */
    public function getActive2($computer, $human)
    {
        if ($human->getTotalScore() >= 100) {
            $human->setWinner();
            return "pig/gameOver";
        } elseif ($computer->getTotalScore() >= 100) {
            $computer->setWinner();
            return "pig/gameOver";
        } else {
            if ($computer->getActive() == true) {
                return "pig/playC";
            } elseif ($human->getActive() == true) {
                if ($human->getDie1() !==1 && $human->getDie2() !==1) {
                    return "pig/playH";
                } else {
                    return "pig/playC";
                }
            }
        }
    }

   /**
    * mainRoll.
    *
    * @return void , void
    */
    public function mainRoll($human, $computer)
    {
        if ($computer->getActive() == true) {
            $computer->setActive(false);
            $human->setActive(true);
        } else {
            // $human->setTotalScore($human->getTotalScore + $human->getTurnScore);
            $computer->setActive(true);
            $human->setActive(false);
        }
        $computer->setTotalScore($computer->getTotalScore() + $computer->getTurnScore());
        $human->setTotalScore($human->getTotalScore() + $human->getTurnScore());
        $computer->setTurnScore(0);
        $human->setTurnScore(0);
        $computer->setRolls(0);
        $human->setRolls(0);
        $human->setDie1(null);
        $human->setDie2(null);
        $computer->setDie1(null);
        $computer->setDie2(null);
    }


    /**
     * mainRoll.
     *
     * @return void , void
     */
    public function mainRoll2($human, $computer)
    {
        if ($computer->getActive() !== true) {
            $human->roll2();
            $human->setRolls($human->getRolls() + 1);
            if ($human->getDie1() !==1 && $human->getDie2() !==1) {
                $human->setTurnScore($human->getTurnScore() + $human->getDiceSum());
            } else {
                $human->setTurnScore(0);
            }
        }
    }


    /**
     * mainRoll.
     *
     * @return void , void
     */
    public function computerRoll($computer, $human)
    {
        $totalHuman = $human->getTotalScore();
        if ($computer->getActive() == true) {
            do {
                $computer->roll2();
                $computer->setRolls($computer->getRolls() + 1);
                $computer->setTurnScore($computer->getTurnScore() + $computer->getDiceSum());
            } while ($computer->rollOrNot($totalHuman) > 1 && ($computer->getDie1() !==1 && $computer->getDie2() !==1));
            if ($computer->getDie1() ==1 || $computer->getDie2() ==1) {
                $computer->setTurnScore(0);
            }
        }
    }


    /**
     * isWinner
     * @return string , isWinner
     */

    public function isWinner2($human, $computer)
    {
        if ($human->isWinner() == true) {
            return $human->getName();
        } else {
            return $computer->getName();
        }
    }
}
