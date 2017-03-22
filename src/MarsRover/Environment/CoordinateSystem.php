<?php
namespace MarsRover\Environment;

class CoordinateSystem
{
    public function __construct()
    {
    }

    public function getPosition()
    {
        return new Position();
    }
}
