<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Reference as BaseReference;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\ReferenceTableMap;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\utils\ActivityObjectInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_reference' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Reference extends BaseReference implements ActivityObjectInterface {
	
	public function toActivityObject() {
		$ao = ActivityObjectQuery::create()
			->filterByClassName(ReferenceTableMap::OM_CLASS)
			->filterByType(ReferenceTableMap::CLASS_DEFAULT)
			->filterByDisplayName($this->getTitle())
			->filterByReferenceId($this->getId())
			->findOne();
	
		if ($ao) {
			return $ao;
		}
	
		$obj = new ActivityObject();
		$obj->setType(ReferenceTableMap::CLASS_DEFAULT);
		$obj->setClassName(ReferenceTableMap::OM_CLASS);
		$obj->setDisplayName($this->getTitle());
		$obj->setReferenceId($this->getId());
		return $obj;
	}

}
