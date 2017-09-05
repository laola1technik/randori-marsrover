<?php
namespace MarsRover\Environment\Orientations;

class East implements Orientation
{
    public function getVector()
    {
        return new Vector(1, 0);
    }
}
