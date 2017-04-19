<?php
namespace MarsRover\Environment;

class Position
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function add($vector)
    {
        return new Position(
            $this->getX() + $vector->getX(),
            $this->getY() + $vector->getY()
        );
    }
}
