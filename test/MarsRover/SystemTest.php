<?php

use MarsRover\Environment\Orientations\East;
use MarsRover\Environment\Position;
use MarsRover\MarsRover;

class SystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldDrive()
    {
        $marsRover = new MarsRover([1, 2], 'N');

        $marsRover->execute("frff");

        $this->assertEquals(new Position(3, 3), $marsRover->getPosition());
        $this->assertEquals(new East(), $marsRover->getOrientation());
    }


}