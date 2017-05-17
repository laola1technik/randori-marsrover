<?php
namespace MarsRover\Environment;

class North implements Direction
{
    public function getVector()
    {
        return new Vector(0,1);
    }
}
