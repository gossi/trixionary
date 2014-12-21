<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\FunctionPhase as BaseFunctionPhase;
use keeko\core\utils\ActivityObjectInterface;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\FunctionPhaseTableMap;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_function_phase' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class FunctionPhase extends BaseFunctionPhase implements ActivityObjectInterface {

	const MAIN = 'main';
	const HELPFUL = 'helpful';
	const SUPPORT = 'support';
	const PREPARE = 'prepare';
	const TRANSITION = 'transition';
	
	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setClassName(FunctionPhaseTableMap::OM_CLASS);
		$obj->setType(FunctionPhaseTableMap::CLASS_DEFAULT);
		$obj->setDisplayName($this->getTitle());
		$obj->setReferenceId($this->getId());
	
		return $obj;
	}
}
