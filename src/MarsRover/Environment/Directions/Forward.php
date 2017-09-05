<?php
namespace MarsRover\Environment\Directions;

class Forward implements Direction
{
    function getDirectionSignum()
    {
        return 1;
    }
}
