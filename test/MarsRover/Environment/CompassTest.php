<?php
namespace MarsRover\Environment;

class CompassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSetInitialOrientation()
    {
        $compass = new Compass(new West());
        $orientation = $compass->getOrientation();
        $this->assertInstanceOf("\\MarsRover\\Environment\\West", $orientation);
    }

    /**
     * @test
     * @dataProvider numberTurnsRight
     */
    public function shouldTurnRight($numberOfTurnsRight, $expectedOrientation)
    {
        $compass = new Compass(new North());

        for ($turn = 1; $turn <= $numberOfTurnsRight; ++$turn) {
            $compass->turnedRight();
        }

        $orientation = $compass->getOrientation();
        $this->assertInstanceOf($expectedOrientation, $orientation);
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
    public function shouldTurnLeft($numberOfTurnsLeft, $expectedOrientation)
    {
        $compass = new Compass(new North());

        for ($turn = 1; $turn <= $numberOfTurnsLeft; ++$turn) {
            $compass->turnedLeft();
        }

        $orientation = $compass->getOrientation();
        $this->assertInstanceOf($expectedOrientation, $orientation);
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