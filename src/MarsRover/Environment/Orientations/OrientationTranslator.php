<?php
namespace MarsRover\Environment\Orientations;

class OrientationTranslator
{
    private $orientationByLetter;

    public function __construct()
    {
        $this->orientationByLetter = [
            "N" => new North(),
            "E" => new East(),
            "S" => new South(),
            "W" => new West()
        ];
    }

    public function translate($orientationLetter)
    {
        return $this->orientationByLetter[$orientationLetter];
    }
}
