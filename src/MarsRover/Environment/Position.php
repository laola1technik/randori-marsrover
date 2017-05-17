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

    public function moduloY($height)
    {
        return new Position($this->x, $this->y % $height);
    }
}
