<?php


use CedarMaps\V1\TileJson;

require_once 'tests/RequestHelper.php';

class TileJsonTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */

    public function shouldAcceptMapIdAsFirstArgument()
    {
        $mockedRequest = new RequestHelper('GET', null, true);
        (new TileJson($mockedRequest))->getTileJson(1);
    }

    /**
     * @test
     */
    public function shouldCreateValidUrlBaseOnMapId()
    {
        $validUrl = 'tiles/1.json';
        $mockedRequest = new RequestHelper('GET', $validUrl);
        (new TileJson($mockedRequest))->getTileJson(1);
    }
}