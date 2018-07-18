<?php

namespace CedarMaps;

use Exception;

class ForwardGeocoding
{
    private $method = 'GET';
    private $requestHelper;
    const VALID_INDEXES = [CedarMaps::Constants['INDEXES']['STREET_INDEX']];
    const VALID_TYPES = CedarMaps::Constants['FORWARD_GEOCODE']['TYPE'];

    public function __construct($requestHelper)
    {
        $this->requestHelper = $requestHelper;
    }

    private function generateForwardGeocodingUrl($query, $index, $filters = [])
    {
        extract($filters);
        $validTypes = array_keys(self::VALID_TYPES);
        if (!empty($location) && $location['lat'] && $location['lon']) {
            $location = "{$location['lat']},{$location['lon']}";
        }

        if (!empty($ne) && $ne['lat'] && $ne['lon']) {
            $ne = "{$ne['lat']},{$ne['lon']}";
        }

        if (!empty($sw) && $sw['lat'] && $sw['lon']) {
            $sw = "{$sw['lat']},{$sw['lon']}";
        }

        if (!empty($type) && is_array($type)) {
            $types = [];
            foreach ($type as $typeItem) {
                if (!in_array($typeItem, $validTypes)) throw new Exception('Invalid type provided');
                $types[] = self::VALID_TYPES[$typeItem];

            }
            $type = implode(',', $types);
        }


        return "geocode/{$index}/{$query}.json?" . http_build_query([
                'limit' => empty($limit) ? null : $limit,
                'location' => empty($location) ? null : $location,
                'distance' => empty($distance) ? null : $distance,
                'type' => empty($type) ? null : $type,
                'ne' => empty($ne) ? null : $ne,
                'sw' => empty($sw) ? null : $sw,
            ]);

    }

    public function getForwardGeocoding($query, $index = null, $filters = [])
    {
        $index = empty($index) ? CedarMaps::Constants['INDEXES']['STREET_INDEX'] : $index;
        if (!in_array($index, self::VALID_INDEXES, true)) throw new Exception('Invalid forward geocode index provided');
        var_dump($this->generateForwardGeocodingUrl($query, $index, $filters));
        return $this->requestHelper->makeRequest($this->method, $this->generateForwardGeocodingUrl($query, $index, $filters));
    }
}