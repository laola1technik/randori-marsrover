<?php
namespace MarsRover\Environment;

class Backward implements Direction
{
    function getDirectionSignum()
    {
        return -1;
    }
}