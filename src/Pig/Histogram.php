<?php

namespace Malm18\Pig;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    // private $min;
    // private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        print_r($this->serie);
        return $this->serie;
    }

    /**
 * Inject the object to use as base for the histogram data.
 *
 * @param HistogramInterface $object The object holding the serie.
 *
 * @return void.
 */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        // $this->min   = $object->getHistogramMin();
        // $this->max   = $object->getHistogramMax();
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $hArray = [];
        for ($i = 1; $i < 7; $i++) {
            $hArray[$i] = " ";
        }
        foreach ($this->serie as $value) {
            // $hArray[$value] = "";
            // $hArray[$value] = str_repeat("*", intval($value));
            $hArray[$value] = "";
        }
        // print_r($this->getHistogramSerie());
        foreach ($this->serie as $value) {
            // $hArray[$value] = "";
            // $hArray[$value] = str_repeat("*", intval($value));
            $hArray[$value] = $hArray[$value].="*";
            // echo $value;
            // echo $hArray[$value];
        }
        // $hArray2 = [];
        // for ($i = 1; $i < 7; $i++) {
        //     $hArray2[$i] = " ";
        // }
        ksort($hArray);
        // print_r($hArray);
        // print_r($hArray2);

        $hString = "";

        foreach ($hArray as $key => $value) {
            $hString .= $key . ": " . $value . "\n" ;
        }

        echo $hString;
    }
}
