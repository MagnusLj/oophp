<?php

namespace Malm18\Pig;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testGetSerie()
    {
        $testHistogram = new Histogram();
        $this->assertInstanceOf("\Malm18\Pig\Histogram", $testHistogram);
        $testArray = [1, 2, 3];
        $testHistogram->setSerie($testArray);
        $res = $testHistogram->getSerie();
        $exp = [1, 2, 3];
        $this->assertEquals($exp, $res);
    }



    /**
     * Test create pig object and set and get die1 and die2.
     *
     */
    public function testHistogramTrait2()
    {
        // $testHistogram = new Histogram();
        $pigX = new Pig();
        // $testHistogramTrait2 = new HistogramTrait2();
        $this->assertInstanceOf("\Malm18\Pig\Pig", $pigX);
        $pigX->addToArray(1, 2);
        $res = $pigX->getHistogramSerie();
        $exp = [1, 2];
        $this->assertEquals($exp, $res);
    }



    /**
     * Test create pig object and set and get TotalScore and TurnScore.
     *
     */
    public function testGetAsText()
    {
        $testHistogram = new Histogram();
        $this->assertInstanceOf("\Malm18\Pig\Histogram", $testHistogram);
        $testArray = [1, 2, 3];
        $testHistogram->setSerie($testArray);
        $res = $testHistogram->getAsText();
        $exp = "1: *\n2: *\n3: *\n4:  \n5:  \n6:  \n";
        $this->assertEquals($exp, $res);
    }


    /**
     * Test create pig object and set and get TotalScore and TurnScore.
     *
     */
    // public function testCreateObjectAndSetAndRoll()
    // {
    //
    // }
}
