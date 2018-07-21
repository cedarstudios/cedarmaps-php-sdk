<?php


use CedarMaps\CedarMaps;
use CedarMaps\V1\ReverseGeocoding;

require_once 'tests/RequestHelper.php';

class ReverseGeocodingTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException RuntimeException
     */

    public function shouldNotAcceptInvalidIndexAsThirdArguments()
    {
        $mockedRequest = new RequestHelper('GET', null, true);
        (new ReverseGeocoding($mockedRequest))->getReverseGeocoding(1, 2, 3);
    }

    /**
     * @test
     */
    public function shouldAcceptValidIndexAsThirdArguments()
    {
        $mockedRequest = new RequestHelper('GET', null, true);
        (new ReverseGeocoding($mockedRequest))->getReverseGeocoding(1, 2);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlWhenValidDirectionArgsProvided()
    {
        $validUrl = 'geocode/cedarmaps.streets/1,2.json';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new ReverseGeocoding($mockedRequest))->getReverseGeocoding(1, 2);
    }
}