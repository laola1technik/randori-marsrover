<?php
namespace MarsRover\Environment;

class MapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSetMapSize()
    {
        $map = new Map(1, 2);

        $this->assertEquals($map->getWidth(), 1);
        $this->assertEquals($map->getHeight(), 2);
    }
}