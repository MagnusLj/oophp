<?php

namespace Malm18\Pig;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class PigTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndSetActiveAndGetActive()
    {
        $pig = new Pig();
        $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);

        $pig->setActive(true);
        $res = $pig->getActive();
        $exp = true;
        $this->assertEquals($exp, $res);
    }



    /**
     * Test create pig object and set and get die1 and die2.
     *
     */
    public function testCreateObjectAndGetDie1AndGetDie2AndSetThem()
    {
        $pig = new Pig();
        $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);

        $pig->setDie1(3);
        $res = $pig->getDie1();
        $exp = 3;
        $this->assertEquals($exp, $res);

        $pig->setDie2(5);
        $res = $pig->getDie2();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }



    /**
     * Test create pig object and set and get TotalScore and TurnScore.
     *
     */
    public function testCreateObjectAndSetAndGetTotalScoreAndTurnScore()
    {
        $pig = new Pig();
        $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);

        $pig->setTotalScore(42);
        $res = $pig->getTotalScore();
        $exp = 42;
        $this->assertEquals($exp, $res);

        $pig->setTurnScore(21);
        $res = $pig->getTurnScore();
        $exp = 21;
        $this->assertEquals($exp, $res);
    }


    /**
     * Test create pig object and set and get TotalScore and TurnScore.
     *
     */
    public function testCreateObjectAndSetAndRoll()
    {
        $pig = new Pig();
        $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);

        $pig->roll();
        $res = $pig->value();
        $exp = 0;
        $this->assertNotEquals($exp, $res);
    }
}
