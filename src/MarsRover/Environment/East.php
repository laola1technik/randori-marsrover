<?php
namespace MarsRover\Environment;

class East implements Direction
{
    public function getVector()
    {
        return new Vector(1, 0);
    }
}
