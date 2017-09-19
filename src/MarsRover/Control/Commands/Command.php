<?php
namespace MarsRover\Control\Commands;

use MarsRover\Control\ControlUnit;

interface Command
{
    public function execute(ControlUnit $controlUnit);
}