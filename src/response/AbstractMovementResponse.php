<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Movement;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for movement, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractMovementResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $movement
	 */
	protected function filter(array $movement) {
		return FilterUtils::blacklistFilter($movement, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Movement $movement
	 */
	protected function movementToArray(Movement $movement) {
		return $this->filter($movement->toArray(TableMap::TYPE_CAMELNAME));
	}
}
