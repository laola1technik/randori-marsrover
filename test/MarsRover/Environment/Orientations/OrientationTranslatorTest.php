<?php
namespace MarsRover\Environment\Orientations;

class OrientationTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider orientationStringAndClass
     */
    public function shouldTranslateNtoNorth($orientationString, $orientationClass)
    {
        $orientationTranslator = new OrientationTranslator();

        $orientation = $orientationTranslator->translate($orientationString);

        $this->assertInstanceOf($orientationClass, $orientation);
    }

    public function orientationStringAndClass()
    {
        return [
          ["N", North::class]
        ];
    }
}
