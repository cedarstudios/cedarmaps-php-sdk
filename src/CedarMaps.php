<?php
/**
 * cedarmaps-php-sdk
 * @package CedarMaps
 * @version 0.1.0
 * @link https://github.com/sinaabadi/cedarmaps-php-sdk
 * @author sinaabadi <https://github.com/sinaabadi>
 * @license https://github.com/sinaabadi/cedarmaps-php-sdk/blob/master/LICENSE
 * @copyright Copyright (c) 2014, sinaabadi
 */

namespace CedarMaps;

use CedarMaps\Helpers\RequestHelper;
use CedarMaps\V1\Direction;
use CedarMaps\V1\Distance;
use CedarMaps\V1\ForwardGeocoding;
use CedarMaps\V1\ReverseGeocoding;
use CedarMaps\V1\TileJson;
use RuntimeException;


require('vendor/autoload.php');

/**
 * The CedarMaps class
 * @author sinaabadi <https://github.com/sinaabadi>
 * @since 0.1.0
 */
class CedarMaps
{
    private $requestHelper;
    const Constants = [
            'INDEXES' => [
            'STREET_INDEX' => 'cedarmaps.streets',
        ],
        'FORWARD_GEOCODE' => [
            'TYPE' => [
                'LOCALITY' => 'locality',
                'ROUNDABOUT' => 'roundabout',
                'STREET' => 'street',
                'FREEWAY' => 'freeway',
                'EXPRESSWAY' => 'expressway',
                'BOULEVARD' => 'boulevard',
            ]
        ],
    ];

    public function __construct($token)
    {
        if (!is_string($token)) throw new RuntimeException('Token must be string');
        $this->requestHelper = new RequestHelper($token);
    }

    public function getDirection($firstPoint, $secondPoint, $options = [])
    {
        $direction = new Direction($this->requestHelper);
        return $direction->getDirection($firstPoint, $secondPoint, $options);
    }

    public function getDistance($points)
    {
        $distance = new Distance($this->requestHelper);
        return $distance->getDistance($points);
    }

    public function getForwardGeocoding($query, $index = null, $filters = [])
    {
        $forwardGeocoding = new ForwardGeocoding($this->requestHelper);
        return $forwardGeocoding->getForwardGeocoding($query, $index, $filters);
    }

    public function getReverseGeocoding($lat, $lon, $index)
    {
        $reverseGeocoding = new ReverseGeocoding($this->requestHelper);
        return $reverseGeocoding->getReverseGeocoding($lat, $lon, $index);
    }

    public function getTileJson($mapId)
    {
        $tileJson = new TileJson($this->requestHelper);
        return $tileJson->getTileJson($mapId);
    }
}
