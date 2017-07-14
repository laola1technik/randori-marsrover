<?php

namespace MarsRover\Environment;

class Compass
{
    /** @var Orientation[] */
    private $orientations;
    private $orientationCount;

    private $orientationIndex;

    public function __construct($initialOrientation)
    {
        $this->orientations = [new North(), new East(), new South(), new West()];
        $this->orientationCount = count($this->orientations);

        $this->orientationIndex = array_search($initialOrientation, $this->orientations);
        if ($this->orientationIndex === false) {
            throw new \InvalidArgumentException("Initial orientation");
        }
    }

    public function getOrientation()
    {
        return $this->orientations[$this->orientationIndex];
    }

    public function turnedRight()
    {
        $this->turn(1);
    }

    public function turnedLeft()
    {
        $this->turn($this->orientationCount - 1);
    }

    private function turn($count)
    {
        $this->orientationIndex = ($this->orientationIndex + $count) % $this->orientationCount;
    }
}
