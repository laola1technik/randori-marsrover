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
        $this->navigation = $this->createNavigation($initialPosition, $initialOrientation);
        $this->commandTranslator = new CommandTranslator();
        $this->controlUnit = new ControlUnit($this->navigation);
    }

    private function createNavigation(array $initialPosition, $initialOrientation)
    {
        $orientationTranslator = new OrientationTranslator();
        $orientation = $orientationTranslator->translate($initialOrientation);

        $map = new Map(100, 100);
        $map->addObstacle(new Position(99, 2));
        $position = new Position($initialPosition[0], $initialPosition[1]);
        $compass = new Compass($orientation);
        return new Navigation($map, $position, $compass);
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

    public function getNotifications()
    {
        //Todo: get notifications from control unit
    }
}
