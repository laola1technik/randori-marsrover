<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\ForwardCommand;

class CommandTranslator
{
    public function __construct()
    {
    }

    public function translate($input)
    {
        return new ForwardCommand();
    }
}
