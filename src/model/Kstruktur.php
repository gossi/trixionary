<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Kstruktur as BaseKstruktur;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\KstrukturTableMap;
use keeko\core\utils\ActivityObjectInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_kstruktur' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Kstruktur extends BaseKstruktur implements ActivityObjectInterface {

	const STRUCTURE = 'structure';
	const EFFECT = 'effect';
	const ACTION = 'action';
	
	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setClassName(KstrukturTableMap::OM_CLASS);
		$obj->setType(KstrukturTableMap::CLASS_DEFAULT);
		$obj->setDisplayName($this->getTitle());
		$obj->setReferenceId($this->getId());

		return $obj;
	}
}
