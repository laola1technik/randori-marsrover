<?php
namespace MarsRover\Environment;

class North
{

    public function __construct()
    {
    }

    public function getVector()
    {
        return new Vector(0,1);
    }
}
