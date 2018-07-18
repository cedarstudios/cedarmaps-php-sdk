<?php

namespace CedarMaps;

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
            if (!$currentPoint['lat'] || !$currentPoint['lng'] || !$previousPoint['lat'] || !$previousPoint['lng']) throw new Exception('Invalid lat or lon provided');

            $result['url'] .= "{$previousPoint['lat']},{$previousPoint['lng']};{$currentPoint['lat']},{$currentPoint['lng']}/";
            $result['index']++;
            return $result;
        }, ['url' => $this->endpoint, 'previousPoint' => null, 'index' => 0]);

        return rtrim($result['url'], '/');
    }

    public function getDistance($points)
    {
        if (!$points || !is_array($points)) throw new Exception('Invalid points provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateDistanceUrl($points));
    }
}