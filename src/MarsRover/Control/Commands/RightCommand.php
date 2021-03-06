<?php
namespace MarsRover\Control\Commands;

use MarsRover\Control\ControlUnit;

class RightCommand implements Command
{
    public function execute(ControlUnit $controlUnit){
        $controlUnit->turnRight();
    }
}
