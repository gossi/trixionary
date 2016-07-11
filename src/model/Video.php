<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Video as BaseVideo;
use gossi\trixionary\model\Map\VideoTableMap;
use gossi\trixionary\serializer\VideoSerializer;
use keeko\core\model\ActivityObject;
use keeko\framework\model\ActivityObjectInterface;
use keeko\framework\model\ApiModelInterface;
use Cocur\Slugify\Slugify;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_video' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Video extends BaseVideo implements ApiModelInterface, ActivityObjectInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return VideoSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new VideoSerializer();
		}

		return self::$serializer;
	}

	/**
	 */
	public function getFilename() {
		$slugifier = new Slugify();
		return $slugifier->slugify($this->getAthlete()) . '-' . $this->getId() . '.mp4';
	}

	/**
	 */
	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setType(ActivityObject::TYPE_VIDEO);
		$obj->setClassName(VideoTableMap::OM_CLASS);
		$obj->setDisplayName($this->getTitle());
		$obj->setReferenceId($this->getId());
		return $obj;
	}
}
