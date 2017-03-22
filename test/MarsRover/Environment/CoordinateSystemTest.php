<?php
namespace MarsRover\Environment;

class CoordinateSystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TODO:
     * 1. rename coordinate to navigation
     * 2. test for navigation
     *  + forward 4 Directions
     *  + backward 4 Directions
     * 3. Wrapping
     * Open Question:
     * Was ist mit Karte oder Welt, wo kommen Hindernisse her, wer bestimmt die Größe
     */

    /**
     * @test
     */
    public function shouldInitiallyBeZeroZero()
    {
        $coordinateSystem = new CoordinateSystem();
        /** @var Position $position */
        $position = $coordinateSystem->getPosition();
        $this->assertSame(0, $position->getX());
        $this->assertSame(0, $position->getY());
    }
}
