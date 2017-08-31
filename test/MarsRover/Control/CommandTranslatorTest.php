<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\Forward;
use MarsRover\Control\Commands\ForwardCommand;

class CommandTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider translatedCommand
     */
    public function shouldTranslateFIntoForwardCommand($input, $expectedCommand)
    {
        $commandTranslator = new CommandTranslator();
        $command = $commandTranslator->translate($input);
        $this->assertInstanceOf($expectedCommand, $command);
    }

    public function translatedCommand()
    {
        return [
            'Forward' => ['f', ForwardCommand::class]
        ];
    }
}