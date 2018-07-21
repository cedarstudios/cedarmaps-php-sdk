<?php
require_once('src/CedarMaps.php');

class  CedarMapsTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals(count(array_diff(self::VALID_METHODS, $classMethods)), 0);
    }


    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldFailWhenProvidingNullAsApiToken()
    {
        new \CedarMaps\CedarMaps(null);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldFailWhenProvidingNoneStringApiToken()
    {
        new \CedarMaps\CedarMaps(123);
    }
}
