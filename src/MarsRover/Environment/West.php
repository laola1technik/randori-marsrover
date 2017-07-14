<?php
namespace MarsRover\Environment;

class West implements Orientation
{
    public function getVector()
    {
        return new Vector(-1, 0);
    }
}
