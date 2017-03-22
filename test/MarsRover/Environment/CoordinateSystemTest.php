<?php
namespace MarsRover\Environment;

class CoordinateSystemTest extends \PHPUnit_Framework_TestCase
{
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
