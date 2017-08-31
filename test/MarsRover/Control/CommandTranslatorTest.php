<?php
namespace MarsRover\Control;

use MarsRover\Control\Commands\Forward;
use MarsRover\Control\Commands\ForwardCommand;

class CommandTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldTranslateFIntoForwardCommand()
    {
        $input = "f";
        $commandTranslator = new CommandTranslator();

        $command = $commandTranslator->translate($input);

        $this->assertInstanceOf(ForwardCommand::class, $command);
    }
}