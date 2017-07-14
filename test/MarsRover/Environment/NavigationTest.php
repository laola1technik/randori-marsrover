<?php
namespace MarsRover\Environment;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Map $map */
    private $map;

    /**
     * @before
     */
    public function setupMap()
    {
        $this->map = new Map(10, 10);
    }

    // ~~~~ DIRECTIONS ~~~~

    /**
     * @test
     */
    public function shouldSetInitialDirection()
    {
        $navigation = new Navigation($this->map, new Position(0, 0), new East());
        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\East', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceEastAfterTurningRight()
    {
        $navigation = new Navigation($this->map, new Position(0, 0), new North());

        $navigation->turnedRight();

        $direction = $navigation->getDirection();
        $this->assertInstanceOf('\MarsRover\Environment\East', $direction);
    }

    /**
     * @test
     */
    public function shouldFaceWestAfterTurningLeft()
    {
        $navigation = new Navigation($this->map, new Position(0, 0), new North());

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
        $navigation = new Navigation($this->map, $initialPosition, new North());
        $this->assertEquals($initialPosition, $navigation->getPosition());
    }

    /**
     * @test
     * @dataProvider positionAfterMovingForwardInDirection
     */
    public function shouldMoveForwardWhenFacingDirection($direction, $expectedPosition)
    {
        $navigation = new Navigation($this->map, new Position(1, 1), $direction);

        $navigation->movedForward();

        $position = $navigation->getPosition();
        $this->assertEquals($expectedPosition, $position);
    }

    public function positionAfterMovingForwardInDirection()
    {
        return [
            'North' => [new North(), new Position(1, 2)],
            'East' => [new East(), new Position(2, 1)],
            'South' => [new South(), new Position(1, 0)],
            'West' => [new West(), new Position(0, 1)]
        ];
    }

    /**
     * @test
     * @dataProvider positionAfterMovingBackwardInDirection
     */
    public function shouldMoveBackwardWhenFacingDirection($direction, $expectedPosition)
    {
        $navigation = new Navigation($this->map, new Position(1, 1), $direction);

        $navigation->movedBackward();

        $position = $navigation->getPosition();
        $this->assertEquals($expectedPosition, $position);
    }

    public function positionAfterMovingBackwardInDirection()
    {
        return [
            'North' => [new North(), new Position(1, 0)],
            'East' => [new East(), new Position(0, 1)],
            'South' => [new South(), new Position(1, 2)],
            'West' => [new West(), new Position(2, 1)]
        ];
    }

    /**
     * @test
     */
    public function shouldWrapUsingMapPositionWhenMovingForward()
    {
        $position = new Position(5, 9);
        $navigation = new Navigation($this->map, $position, new North());

        $navigation->movedForward();

        $this->assertEquals(new Position(5, 0), $navigation->getPosition());
    }

    /**
     * @test
     */
    public function shouldWrapUsingMapPositionWhenMovingBackward()
    {
        $position = new Position(5, 0);
        $navigation = new Navigation($this->map, $position, new North());

        $navigation->movedBackward();

        $this->assertEquals(new Position(5, 9), $navigation->getPosition());
    }

    /**
     * @test
     */
    public function shouldWrapUsingMapPositionWhenMovingBackwardWithMock()
    {
        $map = $this->getMock('\MarsRover\Environment\Map', ['toValidPosition'], [0, 0]);
        $map->expects($this->any())->method('toValidPosition')->will($this->returnValue(new Position(5, 9)));

        $position = new Position(5, 0);
        $navigation = new Navigation($map, $position, new North());

        $navigation->movedBackward();

        $this->assertEquals(new Position(5, 9), $navigation->getPosition());
    }

    /**
     * @test
     * @dataProvider obstacleInFrontOfRoverPosition
     */
    public function shouldCheckIfAbleToMoveForwardWhenFacingObstacle($obstaclePosition, $roverPosition)
    {
        $this->map->addObstacle($obstaclePosition);
        $navigation = new Navigation($this->map, $roverPosition, new North());

        $canMove = $navigation->canMoveForward();

        $this->assertFalse($canMove);
    }

    public function obstacleInFrontOfRoverPosition()
    {
        return [
           'middleOfMap' => [new Position(1, 2), new Position(1, 1)]
        ];
    }

    /**
     * @test
     */
    public function shouldCheckIfAbleToMoveForward()
    {
        $navigation = new Navigation($this->map, new Position(1, 1), new North());

        $canMove = $navigation->canMoveForward();

        $this->assertTrue($canMove);
    }

    /**
     * @test
     */
    public function shouldCheckIfAbleToMoveBackward()
    {
        $navigation = new Navigation($this->map, new Position(1, 1), new North());

        $canMove = $navigation->canMoveBackward();

        $this->assertTrue($canMove);
    }

    /**
     * @test
     */
    public function shouldCheckIfAbleToMoveBackwardWhenFacingObstacle()
    {
        $this->map->addObstacle(new Position(1, 0));
        $navigation = new Navigation($this->map, new Position(1, 1), new North());

        $canMove = $navigation->canMoveBackward();

        $this->assertFalse($canMove);
    }

    /*
     * TODO: check if obstacle is on wrapped position
     */
}
