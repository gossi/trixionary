<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Reference;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for reference, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractReferenceResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $reference
	 */
	protected function filter(array $reference) {
		return FilterUtils::blacklistFilter($reference, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Reference $reference
	 */
	protected function referenceToArray(Reference $reference) {
		return $this->filter($reference->toArray(TableMap::TYPE_CAMELNAME));
	}
}
