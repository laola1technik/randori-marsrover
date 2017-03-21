<?php

require 'MarsRover.php';

class MarsRoverTest extends \PHPUnit_Framework_TestCase
{
    /** @var  MarsRover */
    private $marsRover;

    public function setUp()
    {
        $this->marsRover = new MarsRover();
    }

    /** @test */
    public function setUpWorks()
    {
        $this->assertTrue(true);
    }

}
