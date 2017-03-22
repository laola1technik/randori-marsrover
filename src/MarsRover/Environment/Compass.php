<?php

namespace MarsRover\Environment;

class Compass
{
    private $directions;

    private $directionIndex;

    public function __construct()
    {
        $this->directions = [new North(), new East()];
        $this->directionIndex = 0;
    }

    public function getDirection()
    {
        return $this->directions[$this->directionIndex];
    }

    public function turnedRight()
    {
        $this->directionIndex++;
    }
}
