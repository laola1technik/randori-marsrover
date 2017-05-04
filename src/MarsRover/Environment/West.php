<?php
namespace MarsRover\Environment;

class West implements Direction
{
    public function __construct()
    {
    }

    public function getVector()
    {
        return new Vector(-1, 0);
    }
}
