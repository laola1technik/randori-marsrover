<?php
namespace MarsRover\Control\Commands;

use MarsRover\Control\ControlUnit;

class LeftCommand implements Command
{
    public function execute(ControlUnit $controlUnit){
        $controlUnit->turnLeft();
    }
}
