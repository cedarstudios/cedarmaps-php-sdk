<?php

namespace CedarMaps\V1;

use Exception;

class Direction
{
    private $endpoint = 'direction/cedarmaps.driving';
    private $method = 'GET';
    private $requestHelper;

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateDirectionUrl($points, $options)
    {

        $mappedPoints = array_map(function ($point) {
            return "{$point['lat']},{$point['lon']}";
        }, $points);
        $mappedPoints = implode(';', $mappedPoints);
        $url = "{$this->endpoint}/{$mappedPoints}";
        if (!empty($options['instructions'])) {
            $queryString = http_build_query(['instructions' => (bool)$options['instructions'] ? 'true' : 'false']);
            $url .= "?{$queryString}";
        }

        return $url;

    }

    public function getDirection($points, $options = [])
    {
        if (!is_array($points) || count($points) % 2 !== 0) throw new \RuntimeException('Invalid points provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateDirectionUrl($points, $options));

    }
}