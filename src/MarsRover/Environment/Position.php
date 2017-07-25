<?php
namespace MarsRover\Environment;

class Position
{
    private $x;
    private $y;

    //TODO: Coordinates might lead to error -> rethink: X, Y?
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function add(Vector $vector, Direction $direction)
    {
        return new Position(
            $this->x + $vector->getX() * $direction->getDirectionSignum(),
            $this->y + $vector->getY() * $direction->getDirectionSignum()
        );
    }

    public function wrap(Dimension $dimension)
    {
        $width = $dimension->getWidth();
        $height = $dimension->getHeight();

        $validX = ($this->x + $width) % $width;
        $validY = ($this->y + $height) % $height;

        if ($this->x !== $validX || $this->y !== $validY) {
            return new Position($validX, $validY);
        }

        return $this;
    }
}
