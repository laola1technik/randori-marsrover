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
    public function shouldNotWrapPositionWhenInMapSize()
    {
        $validX = 5;
        $validY = 10;
        $map = new Map(10, 20);

        $position = $map->toValidPosition(new Position($validX, $validY));

        $this->assertEquals(new Position($validX, $validY), $position);
    }

    /**
     * @test
     */
    public function shouldWrapPositionWhenOutOfMapHeight()
    {
        $width = 10;
        $validX = 5;
        $map = new Map($width, 20);

        $position = $map->toValidPosition(new Position($validX, 20));

        $this->assertEquals(new Position($validX, 0), $position);
    }

    /**
     * @test
     */
    public function shouldWrapPositionWhenBelowOfMapHeight()
    {
        $width = 10;
        $validX = 5;
        $map = new Map($width, 20);

        $position = $map->toValidPosition(new Position($validX, -1));

        $this->assertEquals(new Position($validX, 19), $position);
    }

    /**
     * test
     */
    public function shouldWrapPositionWhenOutOfMapWidth()
    {
        $height = 20;
        $validY = 12;
        $map = new Map(10, $height);

        $position = $map->toValidPosition(new Position(10, $validY));

        $this->assertEquals(new Position(0, $validY), $position);
    }
}