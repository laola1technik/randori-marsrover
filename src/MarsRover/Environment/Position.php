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

    //TODO: Test cases for X (Width)
    //TODO: Performance optimization. Don't create a new Object every time
    public function moduloY($map)
    {
        return new Position($this->x, ($this->y + $map->getHeight()) % $map->getHeight());
    }
}
