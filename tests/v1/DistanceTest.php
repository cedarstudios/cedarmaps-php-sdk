<?php


use CedarMaps\V1\Distance;

require_once 'tests/RequestHelper.php';

class DistanceTest extends PHPUnit_Framework_TestCase
{
    static $validPoint1 = ['lat' => 1, 'lon' => 1];
    static $validPoint2 = ['lat' => 2, 'lon' => 2];
    static $validPoint3 = ['lat' => 3, 'lon' => 3];
    static $validPoint4 = ['lat' => 4, 'lon' => 4];


    /**
     * @before
     */
    public function resetValidPoints()
    {
        self::$validPoint1 = ['lat' => 1, 'lon' => 1];
        self::$validPoint2 = ['lat' => 2, 'lon' => 2];
        self::$validPoint3 = ['lat' => 3, 'lon' => 3];
        self::$validPoint4 = ['lat' => 4, 'lon' => 4];
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldNotAcceptOddNumberOfPointsAsArgument()
    {
        $mockedRequest = new RequestHelper('GET', 'test');
        (new Distance($mockedRequest))->getDistance([self::$validPoint1]);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldNotAcceptInvalidPointsAsArgument()
    {
        $mockedRequest = new RequestHelper('GET', 'test');
        (new Distance($mockedRequest))->getDistance(null);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidDistanceForTwoPointProvided()
    {
        $validUrl = 'distance/cedarmaps.driving/1,1;2,2';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new Distance($mockedRequest))->getDistance([self::$validPoint1, self::$validPoint2]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidDistanceForMoreThanTwoPointProvided()
    {
        $validUrl = 'distance/cedarmaps.driving/1,1;2,2/3,3;4,4';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new Distance($mockedRequest))->getDistance([self::$validPoint1, self::$validPoint2, self::$validPoint3, self::$validPoint4]);
    }
}