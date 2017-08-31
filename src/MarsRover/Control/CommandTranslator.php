<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;

class CommandTranslator
{
    public function __construct()
    {
    }

    public function translate($letter)
    {
        if ($letter === 'f') {
            return new ForwardCommand();
        }

        return new BackwardCommand();
    }
}
