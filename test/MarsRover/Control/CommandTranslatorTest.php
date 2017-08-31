<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Control\Commands\LeftCommand;
use MarsRover\Control\Commands\RightCommand;

class CommandTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider lettersAndTranslatedCommands
     */
    public function shouldTranslateLetterIntoCommand($letter, $expectedCommand)
    {
        $commandTranslator = new CommandTranslator();
        $command = $commandTranslator->translate($letter);
        $this->assertInstanceOf($expectedCommand, $command);
    }

    public function lettersAndTranslatedCommands()
    {
        return [
            'Forward' => ['f', ForwardCommand::class],
            'Backward' => ['b', BackwardCommand::class],
            'Left' => ['l', LeftCommand::class],
            'Right' => ['r', RightCommand::class]
        ];
    }
}