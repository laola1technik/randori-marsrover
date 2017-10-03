<?php
namespace MarsRover\Environment\Orientations;

class OrientationTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldTranslateNtoNorth()
    {
        $orientationTranslator = new OrientationTranslator();

        $orientation = $orientationTranslator->translate('N');

        $this->assertInstanceOf(North::class, $orientation);
    }
}
