<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Sport as BaseSport;
use gossi\trixionary\serializer\SportSerializer;
use keeko\framework\model\ApiModelInterface;
use keeko\framework\model\ActivityObjectInterface;
use gossi\trixionary\model\Map\SportTableMap;
use keeko\core\model\ActivityObject;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_sport' table.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Sport extends BaseSport implements ApiModelInterface, ActivityObjectInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return SportSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new SportSerializer();
		}

		return self::$serializer;
	}

	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setType(SportTableMap::CLASS_DEFAULT);
		$obj->setClassName(SportTableMap::OM_CLASS);
		$obj->setDisplayName($this->getTitle());
		$obj->setReferenceId($this->getId());
		return $obj;
	}
}
