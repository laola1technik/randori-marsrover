<?php

namespace MarsRover\Environment;

class Compass
{
    /** @var Direction[] */
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
        $this->turn(1);
    }

    public function turnedLeft()
    {
        $this->turn($this->directionCount - 1);
    }

    private function turn($count)
    {
        $this->directionIndex = ($this->directionIndex + $count) % $this->directionCount;
    }
}
