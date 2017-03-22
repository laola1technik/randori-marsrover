<?php

namespace MarsRover\Environment;

class Compass
{
    private $directions;
    private $directionCount;
    private $directionIndex;

    public function __construct()
    {
        $this->directions = [new North(), new East(), new South(), new West()];
        $this->directionCount = count($this->directions);
        $this->directionIndex = 0;
    }

    public function getDirection()
    {
        return $this->directions[$this->directionIndex];
    }

    public function turnedRight()
    {
        $this->directionIndex = ($this->directionIndex + 1) % $this->directionCount;
    }

    public function turnedLeft()
    {
        $this->directionIndex = ($this->directionIndex + $this->directionCount - 1) % $this->directionCount;
    }
}
