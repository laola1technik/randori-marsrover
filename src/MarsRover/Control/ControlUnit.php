<?php
namespace MarsRover\Control;

use MarsRover\Environment\Directions\Forward;
use MarsRover\Environment\Navigation;

class ControlUnit
{
    private $navigation;

    public function __construct(Navigation $navigation)
    {
        $this->navigation = $navigation;
    }

    public function execute($commands)
    {
        $this->navigation->moved(new Forward());
    }
}
