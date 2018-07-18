<?php
require_once('src/CedarMaps.php');

class  CedarMaps extends PHPUnit_Framework_TestCase
{
    const VALID_METHODS = [
        'getDistance',
        'getDirection',
        'getTileJson',
        'getForwardGeocoding',
        'getReverseGeocoding',

    ];

    /**
     * @test
     */
    public function shouldHaveValidPublicFunctions()
    {
        $classMethods = get_class_methods(new \CedarMaps\CedarMaps('test'));
        $this->assertEquals(array_diff(self::VALID_METHODS, $classMethods), 0);

    }

}
