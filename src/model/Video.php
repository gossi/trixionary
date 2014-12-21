<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Video as BaseVideo;
use keeko\core\utils\ActivityObjectInterface;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\VideoTableMap;
use Cocur\Slugify\Slugify;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_video' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Video extends BaseVideo implements ActivityObjectInterface {

	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setClassName(VideoTableMap::OM_CLASS);
		$obj->setType(VideoTableMap::CLASS_DEFAULT);
		$obj->setDisplayName('Video');
		$obj->setReferenceId($this->getId());

		return $obj;
	}

	public function getFilename() {
		$slugifier = new Slugify();
		return $slugifier->slugify($this->getMovender()) . '-' . $this->getId() . '.mp4';
	}

}
