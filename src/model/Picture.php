<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Picture as BasePicture;
use Cocur\Slugify\Slugify;
use gossi\trixionary\model\Map\PictureTableMap;
use keeko\core\model\ActivityObject;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\utils\ActivityObjectInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_picture' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Picture extends BasePicture implements ActivityObjectInterface {
	
	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setClassName(PictureTableMap::OM_CLASS);
		$obj->setType(PictureTableMap::CLASS_DEFAULT);
		$obj->setDisplayName('Picture');
		$obj->setReferenceId($this->getId());

		return $obj;
	}

	public function getFilename() {
		$slugifier = new Slugify();
		return $slugifier->slugify($this->getMovender()) . '-' . $this->getId() . '.jpg';
	}
}
