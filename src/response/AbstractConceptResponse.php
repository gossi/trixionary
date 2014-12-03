<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Concept;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for concept, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractConceptResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Concept $concept
	 */
	protected function conceptToArray(Concept $concept) {
		return $this->filter($concept->toArray(TableMap::TYPE_CAMELNAME));
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $concept
	 */
	protected function filter(array $concept) {
		return FilterUtils::blacklistFilter($concept, []);
	}
}
