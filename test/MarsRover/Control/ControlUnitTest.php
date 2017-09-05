<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\ForwardCommand;

class ControlUnitTest extends \PHPUnit_Framework_TestCase
{
    /** @var ControlUnit */
    private $controlUnit;

    /**
     * @before
     */
    public function setupControlUnit()
    {
        $this->controlUnit = new ControlUnit();
    }

    /**
     * @test
     */
    public function shouldMoveForwardOnForwardCommand()
    {
        $this->controlUnit->execute([new ForwardCommand()]);

        //TODO Expect Navigation. Move Forward has been called
    }
}