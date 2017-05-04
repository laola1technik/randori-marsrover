<?php
namespace MarsRover\Environment;

class Navigation
{
    /**
     * @var Position
     */
    private $position;
    private $compass;

    public function __construct($initialPosition)
    {
        $this->position = $initialPosition;
        $this->compass = new Compass(new North());
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
        $this->position = $this->position->add($vector);
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
