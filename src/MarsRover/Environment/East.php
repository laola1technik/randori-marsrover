<?php
namespace MarsRover\Environment;

class East implements Orientation
{
    public function getVector()
    {
        return new Vector(1, 0);
    }
}
