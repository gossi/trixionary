<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Sport as BaseSport;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\SportTableMap;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\utils\ActivityObjectInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_sport' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Sport extends BaseSport implements ActivityObjectInterface {

	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setType(SportTableMap::CLASS_DEFAULT);
		$obj->setClassName(SportTableMap::OM_CLASS);
		$obj->setDisplayName($this->getIsDefault() ? 'Trixionary' : $this->getTitle() . ' Trixionary');
		$obj->setReferenceId($this->getId());
		return $obj;
	}
}
