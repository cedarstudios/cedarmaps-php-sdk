<?php

namespace CedarMaps;

use Exception;

class Direction
{
    private $endpoint = 'direction/cedarmaps.driving/';
    private $method = 'GET';
    private $requestHelper;

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateDirectionUrl($points, $options)
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
        $url = rtrim($result['url'], '/');

        if (!empty($options['instructions'])) {
            $queryString = http_build_query(['instructions' => (bool)$options['instructions'] ? 'true' : 'false']);
            $url .= "?{$queryString}";
        }

        return $url;

    }

    public function getDirection($firstPoint, $secondPoint, $options = [])
    {
        if (!$firstPoint || !$secondPoint) throw new Exception('Invalid points provided');
        return $this->requestHelper->makeRequest($this->method, $this->generateDirectionUrl([$firstPoint, $secondPoint], $options));

    }
}