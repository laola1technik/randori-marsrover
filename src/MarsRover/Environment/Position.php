<?php
namespace MarsRover\Environment;

class Position
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @param Vector $vector
     * @return Position
     */
    public function add($vector)
    {
        return new Position(
            $this->x + $vector->getX(),
            $this->y + $vector->getY()
        );
    }

    /**
     * @param Vector $vector
     * @return Position
     */
    public function subtract($vector)
    {
        return new Position(
            $this->x - $vector->getX(),
            $this->y - $vector->getY()
        );
    }

    //TODO: Extract Interface 'Dimension'
    //Map implements Dimension
    //Module uses Type Dimension

    public function wrap(Map $map)
    {
        $width = $map->getWidth();
        $height = $map->getHeight();

        $validX = ($this->x + $width) % $width;
        $validY = ($this->y + $height) % $height;

        if ($this->x !== $validX || $this->y !== $validY) {
            return new Position($validX, $validY);
        }

        return $this;
    }
}
