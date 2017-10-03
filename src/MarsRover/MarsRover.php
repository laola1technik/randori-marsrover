<?php
namespace MarsRover;

use MarsRover\Control\CommandTranslator;
use MarsRover\Control\ControlUnit;
use MarsRover\Environment\Compass;
use MarsRover\Environment\Map;
use MarsRover\Environment\Navigation;
use MarsRover\Environment\Orientations\OrientationTranslator;
use MarsRover\Environment\Position;

class MarsRover
{
    private $navigation;
    private $commandTranslator;

    private $controlUnit;

    public function __construct(array $initialPosition, $initialOrientation)
    {
        $orientationTranslator = new OrientationTranslator();
        $this->navigation = new Navigation(
            new Map(100, 100),
            new Position($initialPosition[0], $initialPosition[1]),
            new Compass($orientationTranslator->translate($initialOrientation))
        );
        $this->commandTranslator = new CommandTranslator();
        $this->controlUnit = new ControlUnit($this->navigation);

    }

    public function execute($commandsString)
    {
        $commands = $this->commandTranslator->translate($commandsString);
        $this->controlUnit->execute($commands);
    }

    public function getPosition()
    {
        return $this->navigation->getPosition();
    }

    public function getOrientation()
    {
        return $this->navigation->getOrientation();
    }
}
