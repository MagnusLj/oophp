<?php

namespace Malm18\Pig;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram2 extends Pig implements HistogramInterface
{
    use HistogramTrait2;



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }



    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    // public function addToArray($aRoll, $bRoll)
    // {
    //     array_push($this->serie, $aRoll, $bRoll);
    //     // return $this->getLastRoll();
    // }
}
