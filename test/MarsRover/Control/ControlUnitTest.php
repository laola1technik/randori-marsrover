<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Environment\Directions\Backward;
use MarsRover\Environment\Directions\Forward;

class ControlUnitTest extends \PHPUnit_Framework_TestCase
{
    /** @var ControlUnit */
    private $controlUnit;

    /**
     * @before
     */
    public function setupControlUnit()
    {
    }

    /**
     * @test
     */
    public function shouldMoveForwardOnForwardCommand()
    {
        $navigation = $this->getMock('\MarsRover\Environment\Navigation', ['moved'], [null, null, null]);
        $navigation->expects($this->once())
            ->method('moved')
            ->with($this->equalTo(new Forward()));

        $this->controlUnit = new ControlUnit($navigation);
        $this->controlUnit->execute([new ForwardCommand()]);
    }

    /**
     * @test
     */
    public function shouldMoveBackwardOnBackwardCommand()
    {
        $navigation = $this->getMock('\MarsRover\Environment\Navigation', ['moved'], [null, null, null]);
        $navigation->expects($this->once())
            ->method('moved')
            ->with($this->equalTo(new Backward()));

        $this->controlUnit = new ControlUnit($navigation);
        $this->controlUnit->execute([new BackwardCommand()]);
    }
}