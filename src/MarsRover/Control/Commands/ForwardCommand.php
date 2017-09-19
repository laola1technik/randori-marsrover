<?php
namespace MarsRover\Control\Commands;

use MarsRover\Control\ControlUnit;

class ForwardCommand implements Command
{
    public function execute(ControlUnit $controlUnit){
        $controlUnit->moveForward();
    }
}
