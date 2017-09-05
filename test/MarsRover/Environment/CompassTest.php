<?php
namespace MarsRover\Environment;

use MarsRover\Environment\Orientations\East;
use MarsRover\Environment\Orientations\North;
use MarsRover\Environment\Orientations\South;
use MarsRover\Environment\Orientations\West;

class CompassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSetInitialOrientation()
    {
        $compass = new Compass(new West());
        $orientation = $compass->getOrientation();
        $this->assertInstanceOf(West::class, $orientation);
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
            [1, East::class],
            [2, South::class],
            [3, West::class],
            [4, North::class],
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
            [1, West::class],
            [2, South::class],
            [3, East::class],
            [4, North::class],
        ];
    }
}