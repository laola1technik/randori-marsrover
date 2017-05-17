<?php
namespace MarsRover\Environment;

class West implements Direction
{
    public function getVector()
    {
        return new Vector(-1, 0);
    }
}
