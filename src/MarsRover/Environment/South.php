<?php
namespace MarsRover\Environment;

class South implements Direction
{
    public function getVector()
    {
        return new Vector(0, -1);
    }
}
