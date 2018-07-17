<?php
require_once(dirname(dirname(__FILE__)) . '/src/sinaabadi/CedarMaps/CedarMaps.php');
use sinaabadi\CedarMaps\CedarMaps as myClass;

class CedarMapsTest extends PHPUnit_Framework_TestCase
{
	public function testCanBeNegated () {
		$a = new myClass();
		$a->increase(9)->increase(8);
		$b = $a->negate();
		$this->assertEquals(0, $b->myParam);
	}

}
