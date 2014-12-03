<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Position;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for position, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractPositionResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $position
	 */
	protected function filter(array $position) {
		return FilterUtils::blacklistFilter($position, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Position $position
	 */
	protected function positionToArray(Position $position) {
		return $this->filter($position->toArray(TableMap::TYPE_CAMELNAME));
	}
}
