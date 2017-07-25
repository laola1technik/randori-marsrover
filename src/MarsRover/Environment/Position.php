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

    /**
     * @param Vector $vector
     * @return Position
     */
    public function plus($vector)
    {
        return new Position(
            $this->x + $vector->getX(),
            $this->y + $vector->getY()
        );
    }

    /**
     * @param Vector $vector
     * @param Direction $direction
     * @return Position
     */

    //TODO: Remove Duplication of Forward/Backward in Position and Navigation using Direction.
    public function add($vector, $direction)
    {
        return new Position(
            $this->x + $vector->getX() * $direction->getDirectionSignum(),
            $this->y + $vector->getY() * $direction->getDirectionSignum()
        );
    }

    /**
     * @param Vector $vector
     * @return Position
     */
    public function minus($vector)
    {
        return new Position(
            $this->x - $vector->getX(),
            $this->y - $vector->getY()
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
