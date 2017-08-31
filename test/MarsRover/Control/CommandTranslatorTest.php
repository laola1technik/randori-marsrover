<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;

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
            'Backward' => ['b', BackwardCommand::class]
        ];
    }
}