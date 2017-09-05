<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Control\Commands\LeftCommand;
use MarsRover\Control\Commands\RightCommand;

class CommandTranslator
{
    private $letterToCommandMap;

    public function __construct()
    {
        $this->letterToCommandMap = [
            "f" => new ForwardCommand(),
            "b" => new BackwardCommand(),
            "l" => new LeftCommand(),
            "r" => new RightCommand()
        ];
    }

    public function translate($letters)
    {
        if (!is_string($letters)) {
            throw new \InvalidArgumentException("Argument 1 passed to translate() must be of the type string");
        }

        if (empty($letters)) {
            return [];
        }

        return array_map([$this, 'translateSingle'], str_split($letters));
    }

    private function translateSingle($letter)
    {
        if (array_key_exists($letter, $this->letterToCommandMap) === false) {
            throw new \InvalidArgumentException("Invalid letter '{$letter}'");
        }

        return $this->letterToCommandMap[$letter];
    }
}
