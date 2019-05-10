<?php

namespace Malm18\Pig;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class PigHandlerTest extends TestCase
{

    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestActive()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $computer->setValue(6);
        $human->setValue(0);
        $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive($computer, $human);
        $exp = "Datorn";
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestActiveAgain()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $human->setValue(6);
        $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive($computer, $human);
        $exp = "Människan";
        $this->assertEquals($exp, $res);
    }





    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestActiveAndGetActiveForHuman()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $human->setActive(true);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive($computer, $human);
        $exp = "Människan";
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestGetActive2forComputer()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/playC";
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestActiveAndGetActiveForHumanAgain()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setValue(6);
        $human->setValue(1);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive($computer, $human);
        $exp = "Datorn";
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestGetActive2forComputerAgain()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        // $computer->setActive(true);
        // $human->setActive(false);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $computer->setValue(6);
        $human->setValue(0);
        $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/playC";
        $this->assertEquals($exp, $res);
    }







    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestGetActive2forHuman()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/playH";
        $this->assertEquals($exp, $res);
    }


    public function testActive2Again()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $human->setTotalScore(100);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/gameOver";
        $this->assertEquals($exp, $res);
    }




    public function testActive2OnceAgainYes()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $computer->setTotalScore(100);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/gameOver";
        $this->assertEquals($exp, $res);
    }



    public function cantTestActive2TooManyTimes()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $human->setTotalScore(12);
        $computer->setTotalScore(12);
        $human->setDie1(1);
        $human->setDie2(1);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->getActive2($computer, $human);
        $exp = "pig/playC";
        $this->assertEquals($exp, $res);
    }






    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestActiveAndGetActiveForComputer()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $human->setWinner(true);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->isWinner2($human, $computer);
        $exp = "Människan";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestmainRoll2()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->mainRoll2($human, $computer);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $human->getRolls();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestComputerRoll()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->computerRoll($computer, $human);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $computer->getRolls();
        $exp = 0;
        $this->assertNotEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestMainRoll()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->mainRoll($human, $computer);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $computer->getActive();
        $exp = false;
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Test getActive and setActive.
     */
    public function testCreateObjectAndTestMainRollAgain()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(false);
        $human->setActive(true);
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        $pigHandler->mainRoll($human, $computer);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $human->getActive();
        $exp = false;
        $this->assertEquals($exp, $res);
    }





    /**
     * Test if isWinner2 works
     *
     */
    public function testisWinner2()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $human->setWinner();
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->isWinner2($human, $computer);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->isWinner2($human, $computer);
        $exp = "Människan";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test if isWinner2 works
     *
     */
    public function testisWinner2b()
    {
        $human = new Pig();
        $computer = new Pig();
        $human->setName("Människan");
        $computer->setName("Datorn");
        $computer->setActive(true);
        $human->setActive(false);
        $computer->setWinner();
        $pigHandler = new PigHandler();
        $this->assertInstanceOf("\Malm18\Pig\PigHandler", $pigHandler);
        // $pigHandler->isWinner2($human, $computer);
        // $pigHandler->active($computer, $human);
        // $human->roll2();
        // $computer->roll2();

        // $pig->setActive(true);
        $res = $pigHandler->isWinner2($human, $computer);
        $exp = "Datorn";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test create pig object and set and get die1 and die2.
     *
     */
    // public function testCreateObjectAndGetDie1AndGetDie2AndSetThem()
    // {
    //     $pig = new Pig();
    //     $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);
    //
    //     $pig->setDie1(3);
    //     $res = $pig->getDie1();
    //     $exp = 3;
    //     $this->assertEquals($exp, $res);
    //
    //     $pig->setDie2(5);
    //     $res = $pig->getDie2();
    //     $exp = 5;
    //     $this->assertEquals($exp, $res);
    // }



    /**
     * Test create pig object and set and get TotalScore and TurnScore.
     *
     */
    // public function testCreateObjectAndSetAndGetTotalScoreAndTurnScore()
    // {
    //     $pig = new Pig();
    //     $this->assertInstanceOf("\Malm18\Pig\Pig", $pig);
    //
    //     $pig->setTotalScore(42);
    //     $res = $pig->getTotalScore();
    //     $exp = 42;
    //     $this->assertEquals($exp, $res);
    //
    //     $pig->setTurnScore(21);
    //     $res = $pig->getTurnScore();
    //     $exp = 21;
    //     $this->assertEquals($exp, $res);
    // }
}
