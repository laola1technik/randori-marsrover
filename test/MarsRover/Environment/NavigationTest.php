<?php
namespace MarsRover\Environment;

use MarsRover\Environment\Directions\Backward;
use MarsRover\Environment\Directions\Forward;
use MarsRover\Environment\Orientations\East;
use MarsRover\Environment\Orientations\North;
use MarsRover\Environment\Orientations\South;
use MarsRover\Environment\Orientations\West;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    const MAP_WIDTH = 15;
    const MAP_HEIGHT = 14;

    /** @var Map $map */
    private $map;

    /**
     * @before
     */
    public function setupMap()
    {
        $this->map = new Map(self::MAP_WIDTH, self::MAP_HEIGHT);
    }

    // ~~~~ DIRECTIONS ~~~~

    /**
     * @test
     */
    public function shouldSetInitialOrientation()
    {
        $navigation = new Navigation($this->map, new Position(0, 0), new Compass(new East()));
        $orientation = $navigation->getOrientation();
        $this->assertInstanceOf(East::class, $orientation);
    }

    /**
     * @test
     */
    public function shouldFaceEastAfterTurningRight()
    {
        $navigation = $this->getNavigationFacingNorthAt(new Position(0, 0));

        $navigation->turnedRight();

        $orientation = $navigation->getOrientation();
        $this->assertInstanceOf(East::class, $orientation);
    }

    /**
     * @test
     */
    public function shouldFaceWestAfterTurningLeft()
    {
        $navigation = $this->getNavigationFacingNorthAt(new Position(0, 0));

        $navigation->turnedLeft();

        $orientation = $navigation->getOrientation();
        $this->assertInstanceOf(West::class, $orientation);
    }

    // ~~~~ POSITIONS ~~~~

    /**
     * @test
     */
    public function shouldSetInitialPosition()
    {
        $initialPosition = new Position(1, 1);
        $navigation = $this->getNavigationFacingNorthAt($initialPosition);
        $this->assertEquals($initialPosition, $navigation->getPosition());
    }

    /**
     * @test
     * @dataProvider positionAfterMovingForwardInDirection
     */
    public function shouldMoveForwardWhenFacingDirection($orientation, $expectedPosition)
    {
        $navigation = new Navigation($this->map, new Position(1, 1), new Compass($orientation));

        $navigation->moved(new Forward());

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
    public function shouldMoveBackwardWhenFacingDirection($orientation, $expectedPosition)
    {
        $navigation = new Navigation($this->map, new Position(1, 1), new Compass($orientation));

        $navigation->moved(new Backward());

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
        $position = new Position(5, self::MAP_HEIGHT - 1);
        $navigation = $this->getNavigationFacingNorthAt($position);

        $navigation->moved(new Forward());

        $this->assertEquals(new Position(5, 0), $navigation->getPosition());
    }

    /**
     * @test
     */
    public function shouldWrapUsingMapPositionWhenMovingBackward()
    {
        $position = new Position(5, 0);
        $navigation = $this->getNavigationFacingNorthAt($position);

        $navigation->moved(new Backward());

        $this->assertEquals(new Position(5, self::MAP_HEIGHT - 1), $navigation->getPosition());
    }

    /**
     * @test
     */
    public function shouldWrapUsingMapPositionWhenMovingBackwardWithMock()
    {
        $map = $this->getMock('\MarsRover\Environment\Map', ['toValidPosition'], [0, 0]);
        $map->expects($this->any())->method('toValidPosition')->will(
            $this->returnValue(new Position(5, self::MAP_HEIGHT - 1))
        );

        $position = new Position(5, 0);
        $navigation = $this->getNavigationFacingNorthAt($position);

        $navigation->moved(new Backward());

        $this->assertEquals(new Position(5, self::MAP_HEIGHT - 1), $navigation->getPosition());
    }

    /**
     * @test
     * @dataProvider obstacleInFrontOfRoverPosition
     */
    public function shouldCheckIfAbleToMoveForwardWhenFacingObstacle($obstaclePosition, $roverPosition)
    {
        $this->map->addObstacle($obstaclePosition);
        $navigation = $this->getNavigationFacingNorthAt($roverPosition);

        $canMove = $navigation->canMove(new Forward());

        $this->assertFalse($canMove);
    }

    public function obstacleInFrontOfRoverPosition()
    {
        return [
            'middleOfMap' => [new Position(1, 2), new Position(1, 1)],
            'edgeOfMap' => [new Position(1, 0), new Position(1, self::MAP_HEIGHT - 1)]
        ];
    }

    /**
     * @test
     */
    public function shouldCheckIfAbleToMoveForward()
    {
        $navigation = $this->getNavigationFacingNorthAt(new Position(1, 1));

        $canMove = $navigation->canMove(new Forward());

        $this->assertTrue($canMove);
    }

    /**
     * @test
     */
    public function shouldCheckIfAbleToMoveBackward()
    {
        $navigation = $this->getNavigationFacingNorthAt(new Position(1, 1));

        $canMove = $navigation->canMove(new Backward());

        $this->assertTrue($canMove);
    }

    /**
     * @test
     * @dataProvider obstacleBehindRoverPosition
     */
    public function shouldCheckIfAbleToMoveBackwardWhenFacingObstacle($obstaclePosition, $roverPosition)
    {
        $this->map->addObstacle($obstaclePosition);
        $navigation = $this->getNavigationFacingNorthAt($roverPosition);

        $canMove = $navigation->canMove(new Backward());

        $this->assertFalse($canMove);
    }

    public function obstacleBehindRoverPosition()
    {
        return [
            'middleOfMap' => [new Position(1, 0), new Position(1, 1)],
            'edgeOfMap' => [new Position(1, self::MAP_HEIGHT - 1), new Position(1, 0)]
        ];
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function shouldFailIfUnableToMoveForward()
    {
        $this->map->addObstacle(new Position(1, 2));
        $navigation = $this->getNavigationFacingNorthAt(new Position(1, 1));

        $navigation->moved(new Forward());
    }

    private function getNavigationFacingNorthAt(Position $position)
    {
        return new Navigation($this->map, $position, new Compass(new North()));
    }
}