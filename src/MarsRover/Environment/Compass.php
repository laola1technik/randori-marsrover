<?php

namespace MarsRover\Environment;

class Compass
{
    public function __construct()
    {
    }

    public function getDirection()
    {
        return new North();
    }
}
