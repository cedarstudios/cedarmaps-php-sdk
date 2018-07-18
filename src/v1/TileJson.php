<?php

namespace CedarMaps;

use Exception;

class TileJson
{
    private $method = 'GET';
    private $requestHelper;

    const VALID_INDEXES = [CedarMaps::Constants['INDEXES']['STREET_INDEX']];

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateTileJsonUrl($mapId)
    {
        return "tiles/{$mapId}.json";
    }

    public function getTileJson($mapId)
    {
        if (empty($mapId)) throw new Exception('Invalid map ID provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateTileJsonUrl($mapId));
    }
}