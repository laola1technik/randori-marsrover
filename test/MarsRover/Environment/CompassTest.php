<?php
namespace MarsRover\Environment;

class CompassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testliste Compass
     * - wohin schauen wir?
     * - rechts drehen
     * - links drehen
     * - jeweils 4 Richtungen
     */

    /**
     * @test
     */
    public function shouldInitiallyPointNorth()
    {
        $compass = new Compass();
        $direction = $compass->getDirection();
        $this->assertInstanceOf("\\MarsRover\\Environment\\North", $direction);
    }

    /**
     * @test
     * @dataProvider numberTurnsRight
     */
    public function shouldTurnRight($numberOfTurnsRight, $expectedDirection)
    {
        $compass = new Compass();

        for ($turn = 1; $turn <= $numberOfTurnsRight; ++$turn) {
            $compass->turnedRight();
        }

        $direction = $compass->getDirection();
        $this->assertInstanceOf($expectedDirection, $direction);
    }

    public function numberTurnsRight()
    {
        return [
            [0, "\\MarsRover\\Environment\\North"],
            [1, "\\MarsRover\\Environment\\East"],
            [2, "\\MarsRover\\Environment\\South"],
            [3, "\\MarsRover\\Environment\\West"],
            [4, "\\MarsRover\\Environment\\North"],
        ];
    }


    /**
     * @test
     * @dataProvider numberTurnsLeft
     */
    public function shouldTurnLeft($numberOfTurnsLeft, $expectedDirection)
    {
        $compass = new Compass();

        for ($turn = 1; $turn <= $numberOfTurnsLeft; ++$turn) {
            $compass->turnedLeft();
        }

        $direction = $compass->getDirection();
        $this->assertInstanceOf($expectedDirection, $direction);
    }

    public function numberTurnsLeft()
    {
        return [
            [1, "\\MarsRover\\Environment\\West"],
            [2, "\\MarsRover\\Environment\\South"],
            [3, "\\MarsRover\\Environment\\East"],
            [4, "\\MarsRover\\Environment\\North"],
        ];
    }
}
