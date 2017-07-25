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
        return $this->canMove(new Forward());
    }

    public function canMoveBackward()
    {
        return $this->canMove(new Backward());
    }

    public function canMove(Direction $direction)
    {
        $position = $this->getMovePosition($direction);
        return !$this->map->isObstacleOn($position);
    }

    // TODO: Don't use moved Forward if not allowed, Check first and report (not here) by throwing exception.
    public function movedForward()
    {
        $this->moved(new Forward());
    }

    public function movedBackward()
    {
        $this->moved(new Backward());
    }

    public function moved(Direction $direction)
    {
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
