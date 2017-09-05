<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\BackwardCommand;
use MarsRover\Control\Commands\ForwardCommand;
use MarsRover\Control\Commands\LeftCommand;
use MarsRover\Control\Commands\RightCommand;

class CommandTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var CommandTranslator */
    private $commandTranslator;

    /**
     * @before
     */
    public function setupCommandTranslator()
    {
        $this->commandTranslator = new CommandTranslator();
    }

    /**
     * @test
     * @dataProvider lettersAndTranslatedCommands
     */
    public function shouldTranslateLetterIntoCommand($letter, $expectedCommand)
    {
        $command = $this->commandTranslator->translate($letter);
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

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailIfUnableToTranslateLetter()
    {
        $invalidLetter = 'p';
        $this->commandTranslator->translate($invalidLetter);
    }
}