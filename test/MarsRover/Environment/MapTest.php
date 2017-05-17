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

    /**
     * @test
     */
    public function shouldNotChangePositionWhenInMapSize()
    {
        $map = new Map(10, 20);
        $position = $map->getPositionOnMapFor(new Position(5, 10));
        $this->assertEquals(new Position(5, 10), $position);
    }

    /**
     * @test
     */
    public function shouldChangePositionWhenOutOfMapHeight()
    {
        $map = new Map(10, 20);
        $position = $map->getPositionOnMapFor(new Position(5, 20));
        $this->assertEquals(new Position(5, 0), $position);
    }

    /**
     * @test
     */
    public function shouldChangePositionWhenBelowOfMapHeight()
    {
        $map = new Map(10, 20);
        $position = $map->getPositionOnMapFor(new Position(5, -1));
        $this->assertEquals(new Position(5, 19), $position);
    }
}