<?php
namespace MarsRover\Environment;

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

    public function __construct($map, $initialPosition, $initialDirection)
    {
        $this->map = $map;
        $this->position = $initialPosition;
        $this->compass = new Compass($initialDirection);
        //TODO: inject compass? (ask karl)
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getDirection()
    {
        return $this->compass->getDirection();
    }

    public function canMoveForward()
    {
        $position = $this->getForwardPosition();
        return !$this->map->isObstacleOn($position);
    }

    private function getForwardPosition()
    {
        $vector = $this->getDirection()->getVector();
        $notValidatedPosition = $this->position->add($vector);
        return $this->map->toValidPosition($notValidatedPosition);
    }

    public function movedForward()
    {
        $this->position = $this->getForwardPosition();
    }

    public function canMoveBackward()
    {
        $position = $this->getBackwardPosition();
        return !$this->map->isObstacleOn($position);
    }

    private function getBackwardPosition()
    {
        $vector = $this->getDirection()->getVector();
        $notValidatedPosition = $this->position->subtract($vector);
        return $this->map->toValidPosition($notValidatedPosition);
    }

    public function movedBackward()
    {
        $this->position = $this->getBackwardPosition();
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
