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
        $this->assertEquals(new North(), $direction);
    }


}
