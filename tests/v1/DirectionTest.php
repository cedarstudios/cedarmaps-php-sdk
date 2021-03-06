<?php


use CedarMaps\V1\Direction;

require_once 'tests/RequestHelper.php';

class DirectionTest extends PHPUnit_Framework_TestCase
{
    static $validPoint1 = ['lat' => 1, 'lon' => 1];
    static $validPoint2 = ['lat' => 2, 'lon' => 2];


    /**
     * @before
     */
    public function resetValidPoints()
    {
        self::$validPoint1 = ['lat' => 1, 'lon' => 1];
        self::$validPoint2 = ['lat' => 2, 'lon' => 2];
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldThrowExceptionForInvalidPointArgument()
    {
        $mockedRequest = new RequestHelper('GET', 'test');
        (new Direction($mockedRequest))->getDirection(null, self::$validPoint2);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldThrowExceptionForInvalidNumberOfPointsArgument()
    {
        $mockedRequest = new RequestHelper('GET', 'test');
        (new Direction($mockedRequest))->getDirection([self::$validPoint1], null);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidArgumentsProvided()
    {
        $validUrl = 'direction/cedarmaps.driving/1,1;2,2';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new Direction($mockedRequest))->getDirection([self::$validPoint1, self::$validPoint2]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidDirectionArgsAndValidOptionProvided()
    {
        $validUrl = 'direction/cedarmaps.driving/1,1;2,2?instructions=true';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new Direction($mockedRequest))->getDirection([self::$validPoint1, self::$validPoint2], ['instructions' => true]);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenMultiplePairOfValidPointsProvided()
    {
        $validUrl = 'direction/cedarmaps.driving/1,1;2,2;1,1;2,2';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new Direction($mockedRequest))->getDirection([self::$validPoint1, self::$validPoint2,self::$validPoint1, self::$validPoint2]);
    }
}