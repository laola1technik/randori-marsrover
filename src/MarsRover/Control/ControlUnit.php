<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
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
                $this->navigation->moved(new Forward());
            } elseif ($command instanceof BackwardCommand) {
                $this->navigation->moved(new Backward());
            }
        }
    }
}
