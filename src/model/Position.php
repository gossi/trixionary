<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Position as BasePosition;
use gossi\trixionary\serializer\PositionSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_position' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Position extends BasePosition implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return PositionSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new PositionSerializer();
		}

		return self::$serializer;
	}
}
