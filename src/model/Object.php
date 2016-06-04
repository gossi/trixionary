<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Object as BaseObject;
use gossi\trixionary\serializer\ObjectSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_object' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Object extends BaseObject implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return ObjectSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new ObjectSerializer();
		}

		return self::$serializer;
	}
}
