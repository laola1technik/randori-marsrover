<?php
namespace MarsRover\Environment;

class Navigation
{
    private $position;
    private $compass;

    public function __construct()
    {
        $this->position = new Position(0, 0);
        $this->compass = new Compass();
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
        $this->position = new Position(
            $this->position->getX(),
            $this->position->getY() + 1);
    }

    public function turnedRight()
    {
        $this->compass->turnedRight();
    }
}
