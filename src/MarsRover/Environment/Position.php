<?php
namespace MarsRover\Environment;

class Position
{
    private $x;
    private $y;

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
}
