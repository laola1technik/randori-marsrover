<?php
namespace MarsRover\Environment\Orientations;

class OrientationTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider orientationLetterAndClass
     */
    public function shouldTranslateLetterToOrientation($orientationLetter, $orientationClass)
    {
        $orientationTranslator = new OrientationTranslator();

        $orientation = $orientationTranslator->translate($orientationLetter);

        $this->assertInstanceOf($orientationClass, $orientation);
    }

    public function orientationLetterAndClass()
    {
        return [
            "N" => ["N", North::class],
            "E" => ["E", East::class],
            "S" => ["S", South::class],
            "W" => ["W", West::class]
        ];
    }
}
