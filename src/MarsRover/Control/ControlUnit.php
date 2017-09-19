<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\Command;
use MarsRover\Environment\Directions\Backward;
use MarsRover\Environment\Directions\Forward;
use MarsRover\Environment\Navigation;

class ControlUnit
{
    private $navigation;

    public function __construct(Navigation $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * @param Command[] $commands
     */
    public function execute(array $commands)
    {
        foreach ($commands as $command) {
            $command->execute($this);
        }
    }

    public function moveForward()
    {
        // start the engine
        $this->navigation->moved(new Forward());
    }

    public function moveBackward()
    {
        $this->navigation->moved(new Backward());
    }

    public function turnRight()
    {
        $this->navigation->turnedRight();
    }

    public function turnLeft()
    {
        $this->navigation->turnedLeft();
    }
}
