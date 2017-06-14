<?php

namespace MarsRover\Environment;


class Map implements Dimension
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
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
}