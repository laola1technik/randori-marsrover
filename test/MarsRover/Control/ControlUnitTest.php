<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Environment\Directions\Backward;
use MarsRover\Environment\Directions\Forward;
use MarsRover\Environment\Navigation;

class ControlUnitTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Navigation | \PHPUnit_Framework_MockObject_MockObject */
    private $navigation;
    /** @var ControlUnit */
    private $controlUnit;

    /**
     * @before
     */
    public function setupControlUnit()
    {
        $this->navigation = $this->getMock(Navigation::class, ['moved'], [null, null, null]);
        $this->controlUnit = new ControlUnit($this->navigation);
    }

    /**
     * @test
     */
    public function shouldMoveForwardOnForwardCommand()
    {
        $this->navigation->expects($this->once())
            ->method('moved')
            ->with($this->equalTo(new Forward()));

        $this->controlUnit->execute([new ForwardCommand()]);
    }

    /**
     * @test
     */
    public function shouldMoveBackwardOnBackwardCommand()
    {
        $this->navigation->expects($this->once())
            ->method('moved')
            ->with($this->equalTo(new Backward()));

        $this->controlUnit->execute([new BackwardCommand()]);
    }

    /**
     * @test
     */
    public function shouldMoveBackwardTwiceOnTwoBackwardCommands()
    {
        $this->navigation->expects($this->exactly(2))
            ->method('moved')
            ->with($this->equalTo(new Backward()));

        $this->controlUnit->execute([new BackwardCommand(), new BackwardCommand()]);
    }
}