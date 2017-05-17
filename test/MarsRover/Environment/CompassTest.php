<?php
namespace MarsRover\Environment;

class CompassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSetInitialDirection()
    {
        $compass = new Compass(new West());
        $direction = $compass->getDirection();
        $this->assertInstanceOf("\\MarsRover\\Environment\\West", $direction);
    }

    /**
     * @test
     * @dataProvider numberTurnsRight
     */
    public function shouldTurnRight($numberOfTurnsRight, $expectedDirection)
    {
        $compass = new Compass(new North());

        for ($turn = 1; $turn <= $numberOfTurnsRight; ++$turn) {
            $compass->turnedRight();
        }

        $direction = $compass->getDirection();
        $this->assertInstanceOf($expectedDirection, $direction);
    }

    public function numberTurnsRight()
    {
        return [
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
        $compass = new Compass(new North());

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