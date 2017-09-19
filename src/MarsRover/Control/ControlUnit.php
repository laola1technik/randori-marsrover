<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Control\Commands\LeftCommand;
use MarsRover\Control\Commands\RightCommand;
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

    public function execute(array $commands)
    {
        foreach ($commands as $command) {
            if ($command instanceof ForwardCommand) {
                // start the engine
                $this->navigation->moved(new Forward());
            } elseif ($command instanceof BackwardCommand) {
                $this->navigation->moved(new Backward());
            } elseif ($command instanceof RightCommand) {
                $this->navigation->turnedRight();
            } elseif ($command instanceof LeftCommand) {
                $this->navigation->turnedLeft();
            }
        }
    }
}
