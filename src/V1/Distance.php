<?php

namespace CedarMaps\V1;


use Exception;

class Distance
{
    private $endpoint = 'distance/cedarmaps.driving/';
    private $method = 'GET';
    private $requestHelper;

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateDistanceUrl($points)
    {
        $result = array_reduce($points, function ($result, $currentPoint) {
            if ($result['index'] % 2 === 0) {
                $result['previousPoint'] = $currentPoint;
                $result['index']++;
                return $result;
            }
            $previousPoint = $result['previousPoint'];
            if (!$currentPoint['lat'] || !$currentPoint['lon'] || !$previousPoint['lat'] || !$previousPoint['lon']) throw new Exception('Invalid lat or lon provided');

            $result['url'] .= "{$previousPoint['lat']},{$previousPoint['lon']};{$currentPoint['lat']},{$currentPoint['lon']}/";
            $result['index']++;
            return $result;
        }, ['url' => $this->endpoint, 'previousPoint' => null, 'index' => 0]);

        return rtrim($result['url'], '/');
    }

    public function getDistance($points)
    {
        if (!$points || !is_array($points) || count($points) % 2 === 1) throw new \RuntimeException('Invalid points provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateDistanceUrl($points));
    }
}