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

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/vendor/autoload.php');

/**
 * The CedarMaps class
 * @author sinaabadi <https://github.com/sinaabadi>
 * @since 0.1.0
 */
class CedarMaps {

	/**
	 * A sample parameter
	 * @var int $myParam This is my parameter
	 * @since 0.1.0
	 */
	public $myParam = 0;

	/**
	 * A sample function that adds the $n param to $myParam
	 * @name increase
	 * @param int $n The number to add to $myParam
	 * @since 0.1.0
	 * @return object the CedarMaps object
	 */
	public function increase ( $n ) {
		$this->myParam += $n;
		return $this;
	}

	/**
	 * A sample function that sets $myParam to 0
	 * @name negate
	 * @since 0.1.0
	 * @return object the CedarMaps object
	 */
	public function negate (){
		$this->myParam = 0;
		return $this;
	}
}
