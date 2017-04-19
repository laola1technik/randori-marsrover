<?php
namespace MarsRover\Environment;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TODO:
     * 2. test for navigation
     *  + forward 4 Directions
     *  + backward 4 Directions
     * 3. Wrapping
     * Open Question:
     * Was ist mit Karte oder Welt, wo kommen Hindernisse her, wer bestimmt die Größe
     */

    /**
     * @test
     */
    public function shouldInitiallyBeZeroZero()
    {
        $navigation = new Navigation();
        /** @var Position $position */
        $position = $navigation->getPosition();
        $this->assertSame(0, $position->getX());
        $this->assertSame(0, $position->getY());
    }

    /**
     * @test
     */
    public function shouldInitiallyFaceNorth()
    {
        $navigation = new Navigation();
        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\North', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceEastAfterTurningRight()
    {
        $navigation = new Navigation();
        $navigation->turnedRight();
        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\East', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceWestAfterTurningLeft()
    {
        $navigation = new Navigation();
        $navigation->turnedLeft();
        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\West', $direction);
    }

    /**
     * @test
     */
    public function shouldUpdateToZeroOneAfterMovingForwardWhenFacingNorth()
    {
        $navigation = new Navigation();

        $navigation->movedForward();

        /** @var Position $position */
        $position = $navigation->getPosition();
        $this->assertSame(0, $position->getX());
        $this->assertSame(1, $position->getY());
    }


}
