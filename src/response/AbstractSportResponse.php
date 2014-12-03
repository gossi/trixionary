<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Sport;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for sport, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractSportResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $sport
	 */
	protected function filter(array $sport) {
		return FilterUtils::blacklistFilter($sport, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Sport $sport
	 */
	protected function sportToArray(Sport $sport) {
		return $this->filter($sport->toArray(TableMap::TYPE_CAMELNAME));
	}
}
