<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\FunctionPhase;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for function_phase, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractFunctionPhaseResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $function_phase
	 */
	protected function filter(array $function_phase) {
		return FilterUtils::blacklistFilter($function_phase, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param FunctionPhase $function_phase
	 */
	protected function function_phaseToArray(FunctionPhase $function_phase) {
		return $this->filter($function_phase->toArray(TableMap::TYPE_CAMELNAME));
	}
}
