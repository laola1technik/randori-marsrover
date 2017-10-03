<?php
namespace MarsRover\Environment\Orientations;

class OrientationTranslator
{
    public function translate($orientationString)
    {
        return new North();
    }
}
