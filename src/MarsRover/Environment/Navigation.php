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

    public function __construct($map, $initialPosition, $initialOrientation)
    {
        $this->map = $map;
        $this->position = $initialPosition;
        $this->compass = new Compass($initialOrientation);
        //TODO: inject compass? (ask karl)
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getOrientation()
    {
        return $this->compass->getOrientation();
    }

    public function canMoveForward()
    {
        $position = $this->getMovePosition(new Forward());
        return !$this->map->isObstacleOn($position);
    }

    // TODO: Don't use moved Forward if not allowed, Check first and report (not here) by throwing exception.
    public function movedForward()
    {
        $this->position = $this->getMovePosition(new Forward());
    }

    public function canMoveBackward()
    {
        $position = $this->getMovePosition(new Backward());
        return !$this->map->isObstacleOn($position);
    }

    public function movedBackward()
    {
        $this->position = $this->getMovePosition(new Backward());
    }

    private function getMovePosition($direction)
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
