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

namespace sinaabadi\CedarMaps;

use Exception;

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/vendor/autoload.php');

/**
 * The CedarMaps class
 * @author sinaabadi <https://github.com/sinaabadi>
 * @since 0.1.0
 */
class CedarMaps
{
    private $token;

    public function __construct($token)
    {
        if(!is_string($token)) throw new Exception('Token must be string');

    }
}
