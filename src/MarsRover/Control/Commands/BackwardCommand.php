<?php
namespace MarsRover\Control\Commands;

use MarsRover\Control\ControlUnit;

class BackwardCommand implements Command
{
    public function execute(ControlUnit $controlUnit){
        $controlUnit->moveBackward();
    }
}
