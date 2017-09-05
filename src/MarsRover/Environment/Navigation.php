<?php
namespace MarsRover\Environment;

use MarsRover\Environment\Directions\Direction;

class Navigation
{
    /**
     * @var Map
     */
    private $map;
    /**
     * @var Position
     */
    private $position;
    private $compass;

    public function __construct($map, $initialPosition, $compass)
    {
        $this->map = $map;
        $this->position = $initialPosition;
        $this->compass = $compass;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getOrientation()
    {
        return $this->compass->getOrientation();
    }

    public function canMove(Direction $direction)
    {
        $position = $this->getMovePosition($direction);
        return !$this->map->isObstacleOn($position);
    }

    public function moved(Direction $direction)
    {
        if (!$this->canMove($direction)) {
            throw new \LogicException("Obstacle is blocking your way :(");
        }
        $this->position = $this->getMovePosition($direction);
    }

    private function getMovePosition(Direction $direction)
    {
        $vector = $this->getOrientation()->getVector();
        $notValidatedPosition = $this->position->add($vector, $direction);
        return $this->map->toValidPosition($notValidatedPosition);
    }

    public function turnedRight()
    {
        $this->compass->turnedRight();
    }

    public function turnedLeft()
    {
        $this->compass->turnedLeft();
    }
}
