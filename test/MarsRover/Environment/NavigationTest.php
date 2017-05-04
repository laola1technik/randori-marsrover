<?php
namespace MarsRover\Environment;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TODO:
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
     * @dataProvider coordinatesAfterNumberOfTurnsRightMovingForward
     */
    public function shouldUpdateToCoordinateAfterMovingForwardWhenFacingDirection(
        $numberOfTurnsRight,
        $expectedCoordinate
    ) {
        $navigation = new Navigation();

        for ($i = 0; $i < $numberOfTurnsRight; $i++) {
            $navigation->turnedRight();
        }

        $navigation->movedForward();

        /** @var Position $position */
        $position = $navigation->getPosition();
        $this->assertEquals($expectedCoordinate, $position);
    }

    public function coordinatesAfterNumberOfTurnsRightMovingForward()
    {
        return [
            'North' => [0, new Position(0, 1)],
            'East' => [1, new Position(1, 0)],
            'South' => [2, new Position(0, -1)],
            'West' => [3, new Position(-1, 0)]
        ];
    }

    /**
     * @test
     * @dataProvider coordinatesAfterNumberOfTurnsRightMovingBackward
     */
    public function shouldUpdateToCoordinateAfterMovingBackwardWhenFacingDirection(
        $numberOfTurnsRight,
        $expectedCoordinate
    ) {
        $navigation = new Navigation();

        for ($i = 0; $i < $numberOfTurnsRight; $i++) {
            $navigation->turnedRight();
        }

        $navigation->movedBackward();

        /** @var Position $position */
        $position = $navigation->getPosition();
        $this->assertEquals($expectedCoordinate, $position);
    }

    public function coordinatesAfterNumberOfTurnsRightMovingBackward()
    {
        return [
            'North' => [0, new Position(0, -1)],
            'East' => [1, new Position(-1, 0)],
            'South' => [2, new Position(0, 1)],
            'West' => [3, new Position(1, 0)]
        ];
    }

}
