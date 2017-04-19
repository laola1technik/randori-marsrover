<?php
namespace MarsRover\Environment;

class Navigation
{
    public function __construct()
    {
    }

    public function getPosition()
    {
        return new Position();
    }

    public function getDirection()
    {
        return new North();
    }
}
