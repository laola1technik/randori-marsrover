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

    public function movedForward()
    {
        $vector = $this->getDirection()->getVector();
        $notValidatedPosition = $this->position->add($vector);
        $this->position = $this->map->toValidPosition($notValidatedPosition);
    }

    public function movedBackward()
    {
        $vector = $this->getDirection()->getVector();
        $this->position = $this->position->subtract($vector);
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
