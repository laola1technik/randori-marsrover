<?php
namespace MarsRover\Environment;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TODO:
     * 2. test for navigation
     *  + forward 2 Directions (s, w; paramterised?)
     *  + backward 4 Directions (subtract vector)
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
     * @dataProvider coordinatesAfterNumberOfTurnsRight
     */
    public function shouldUpdateToCoordinateAfterMovingForwardWhenFacingDirection($numberOfTurnsRight, $expectedCoordinate)
    {
        $navigation = new Navigation();

        for ($i = 0; $i < $numberOfTurnsRight; $i++) {
            $navigation->turnedRight();
        }

        $navigation->movedForward();


        /** @var Position $position */
        $position = $navigation->getPosition();
        $this->assertEquals($expectedCoordinate, $position);
    }

    public function coordinatesAfterNumberOfTurnsRight()
    {
        return [
            [0, new Position(0, 1)],
            [1, new Position(1, 0)],
            [2, new Position(0, -1)],
            [3, new Position(-1, 0)]
        ];
    }


}
