<?php
/**
 * Created by PhpStorm.
 * User: marko.markovic
 * Date: 17.05.2017
 * Time: 16:52
 */

namespace MarsRover\Environment;


class Map
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

    public function getPositionOnMapFor(Position $position)
    {
        return $position->moduloY($this);
    }
}