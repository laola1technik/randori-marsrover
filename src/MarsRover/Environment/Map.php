<?php

namespace MarsRover\Environment;


class Map implements Dimension
{
    private $width;
    private $height;
    private $obstacles;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->obstacles = [];
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function toValidPosition(Position $position)
    {
        return $position->wrap($this);
    }

    public function isObstacleOn(Position $position)
    {
        return in_array($position, $this->obstacles) !== false;
    }

    public function addObstacle($occupiedPosition)
    {
        array_push($this->obstacles, $occupiedPosition);
    }
}