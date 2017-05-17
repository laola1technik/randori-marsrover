<?php
namespace MarsRover\Environment;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TODO:
     * 3. Wrapping
     * Open Question:
     * Was ist mit Karte oder Welt, wo kommen Hindernisse her, wer bestimmt die Größe
     * Überlegung: Setup, Assert Position und Assert Direction herausziehen
     */

    // ~~~~ DIRECTIONS ~~~~

    /**
     * @test
     */
    public function shouldSetInitialDirection()
    {
        $navigation = new Navigation(new Position(0, 0), new East());
        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\East', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceEastAfterTurningRight()
    {
        $navigation = new Navigation(new Position(0, 0), new North());

        $navigation->turnedRight();

        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\East', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceWestAfterTurningLeft()
    {
        $navigation = new Navigation(new Position(0, 0), new North());

        $navigation->turnedLeft();

        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\West', $direction);
    }

    // ~~~~ POSITIONS ~~~~

    /**
     * @test
     */
    public function shouldSetInitialPosition()
    {
        $initialPosition = new Position(1, 1);
        $navigation = new Navigation($initialPosition, new North());
        $this->assertEquals($initialPosition, $navigation->getPosition());
    }

    /**
     * @test
     * @dataProvider positionAfterMovingForwardInDirection
     */
    public function shouldMoveForwardWhenFacingDirection($direction, $expectedPosition)
    {
        $navigation = new Navigation(new Position(0, 0), $direction);

        $navigation->movedForward();

        $position = $navigation->getPosition();
        $this->assertEquals($expectedPosition, $position);
    }

    public function positionAfterMovingForwardInDirection()
    {
        return [
            'North' => [new North(), new Position(0, 1)],
            'East' => [new East(), new Position(1, 0)],
            'South' => [new South(), new Position(0, -1)],
            'West' => [new West(), new Position(-1, 0)]
        ];
    }

    /**
     * @test
     * @dataProvider positionAfterMovingBackwardInDirection
     */
    public function shouldMoveBackwardWhenFacingDirection($direction, $expectedPosition)
    {
        $navigation = new Navigation(new Position(0, 0), $direction);

        $navigation->movedBackward();

        $position = $navigation->getPosition();
        $this->assertEquals($expectedPosition, $position);
    }

    public function positionAfterMovingBackwardInDirection()
    {
        return [
            'North' => [new North(), new Position(0, -1)],
            'East' => [new East(), new Position(-1, 0)],
            'South' => [new South(), new Position(0, 1)],
            'West' => [new West(), new Position(1, 0)]
        ];
    }
}
