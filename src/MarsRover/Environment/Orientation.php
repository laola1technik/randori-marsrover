<?php
namespace MarsRover\Environment;

/**
 * Cardinal direction / Orientation the rover is facing.
 */
interface Orientation
{
    /**
     * @return Vector
     */
    public function getVector();
}
