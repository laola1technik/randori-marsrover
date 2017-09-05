<?php
namespace MarsRover\Environment\Orientations;

class South implements Orientation
{
    public function getVector()
    {
        return new Vector(0, -1);
    }
}
