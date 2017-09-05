<?php
namespace MarsRover\Environment\Directions;

class Backward implements Direction
{
    function getDirectionSignum()
    {
        return -1;
    }
}