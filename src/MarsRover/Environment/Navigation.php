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
        $vector = $this->getDirection()->getVector();
        $this->position = new Position(
            $this->position->getX() + $vector->getX(),
            $this->position->getY() + $vector->getY());
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
