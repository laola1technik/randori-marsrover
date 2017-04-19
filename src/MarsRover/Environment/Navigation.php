<?php
namespace MarsRover\Environment;

class Navigation
{
    private $position;

    public function __construct()
    {
        $this->position = new Position(0, 0);
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getDirection()
    {
        return new North();
    }

    public function movedForward()
    {
        $this->position = new Position(
            $this->position->getX(),
            $this->position->getY() + 1);
    }
}
