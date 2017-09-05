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
        $commands = [];
        $splittedLetters = str_split($letters);
        foreach ($splittedLetters as $letter) {
            $commands[] = $this->translateSingle($letter);
        }
        return $commands;
    }

    private function translateSingle($letter)
    {
        if (array_key_exists($letter, $this->letterToCommandMap) === false) {
            throw new \InvalidArgumentException("Invalid letter '{$letter}'");
        }

        return $this->letterToCommandMap[$letter];
    }
}
