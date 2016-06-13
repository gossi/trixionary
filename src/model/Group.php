<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Group as BaseGroup;
use gossi\trixionary\serializer\GroupSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_group' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Group extends BaseGroup implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return GroupSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new GroupSerializer();
		}

		return self::$serializer;
	}
}
