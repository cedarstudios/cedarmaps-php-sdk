<?php

namespace CedarMaps;

use Exception;

class ReverseGeocoding
{
    private $method = 'GET';
    private $requestHelper;

    const VALID_INDEXES = [CedarMaps::Constants['INDEXES']['STREET_INDEX']];

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateReverseGeocodingUrl($lat, $lon, $index)
    {
        if (empty($lat) || empty($lon)) throw new Exception('Invalid lat or lon provided');

        return "geocode/{$index}/{$lat},{$lon}.json";
    }

    public function getReverseGeocoding($lat, $lon, $index)
    {
        if (!in_array($index, self::VALID_INDEXES, true)) throw new Exception('Invalid reverse geocode index provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateReverseGeocodingUrl($lat, $lon, $index));
    }
}