<?php

namespace MarsRover\Environment;

class Compass
{
    /** @var Direction[] */
    private $directions;
    private $directionCount;

    private $directionIndex;

    public function __construct($initialDirection)
    {
        $this->directions = [new North(), new East(), new South(), new West()];
        $this->directionCount = count($this->directions);

        $this->directionIndex = array_search($initialDirection, $this->directions);
        if ($this->directionIndex === false) {
            throw new \InvalidArgumentException("Initial direction");
        }
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
