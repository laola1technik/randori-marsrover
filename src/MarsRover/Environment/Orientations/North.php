<?php
namespace MarsRover\Environment\Orientations;

class North implements Orientation
{
    public function getVector()
    {
        return new Vector(0,1);
    }
}
