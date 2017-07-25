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
        $position = $this->getForwardPosition();
        return !$this->map->isObstacleOn($position);
    }

    private function getForwardPosition()
    {
        $vector = $this->getOrientation()->getVector();
        $notValidatedPosition = $this->position->add($vector, new Forward());
        return $this->map->toValidPosition($notValidatedPosition);
    }

    // TODO: Don't use moved Forward if not allowed, Check first and report (not here) by throwing exception.
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
        $vector = $this->getOrientation()->getVector();
        $notValidatedPosition = $this->position->add($vector, new Backward());
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
