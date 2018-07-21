<?php


use CedarMaps\CedarMaps;
use CedarMaps\V1\ForwardGeocoding;

require_once 'tests/RequestHelper.php';

class ForwardGeocodingTest extends PHPUnit_Framework_TestCase
{
    static $validPoint1 = ['lat' => 1, 'lon' => 1];
    static $validPoint2 = ['lat' => 2, 'lon' => 2];
    static $validQuery = 'test';
    static $validIndex;


    /**
     * @before
     */
    public function resetValidPoints()
    {
        self::$validPoint1 = ['lat' => 1, 'lon' => 1];
        self::$validPoint2 = ['lat' => 2, 'lon' => 2];
        self::$validQuery = 'test';
        self::$validIndex = CedarMaps::Constants['INDEXES']['STREET_INDEX'];
    }

    /**
     * @test
     */
    public function shouldAcceptRequiredQueryAsFirstArg()
    {
        $mockedRequest = new RequestHelper('GET', 'test', true);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldNotAcceptInvalidIndexAsSecondArg()
    {
        $mockedRequest = new RequestHelper('GET', 'test', true);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, 'test');
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithLimitOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?limit=1';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex, ['limit' => 1]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithDistanceOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?distance=1';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex, ['distance' => 1]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithLocationOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?location=1,1';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex, ['location' => self::$validPoint1]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithTypeOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?type=locality';
        $types = CedarMaps::Constants['FORWARD_GEOCODE']['TYPE'];
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex, ['type' => [$types['LOCALITY']]]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithMultipleTypeOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?type=locality,boulevard';
        $types = CedarMaps::Constants['FORWARD_GEOCODE']['TYPE'];
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery, self::$validIndex,
            ['type' => [$types['LOCALITY'], $types['BOULEVARD']]]);
    }


    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidQueryWithNeAndSwOptionProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/test.json?ne=1,1&sw=2,2';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ForwardGeocoding($mockedRequest))->getForwardGeocoding(self::$validQuery,
            self::$validIndex, ['ne' => self::$validPoint1, 'sw' => self::$validPoint2]);
    }

}