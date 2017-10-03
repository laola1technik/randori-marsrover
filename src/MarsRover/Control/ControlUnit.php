<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\Command;
use MarsRover\Environment\Directions\Backward;
use MarsRover\Environment\Directions\Forward;
use MarsRover\Environment\Navigation;

/**
 * Offers all available actions the rover can perform.
 */
class ControlUnit
{
    private $navigation;
    private $cancel;

    public function __construct(Navigation $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * @param Command[] $commands
     */
    public function execute(array $commands)
    {
        $this->cancel = false;
        foreach ($commands as $command) {
            $command->execute($this);
            if ($this->cancel) {
                break;
            }
        }
    }

    public function moveForward()
    {
        // start the engine
        $this->navigation->moved(new Forward());
    }

    public function moveBackward()
    {
        if ($this->navigation->canMove(new Backward())) {
            $this->navigation->moved(new Backward());
        } else {
            $this->cancel = true;
        }
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
