<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Reference as BaseReference;
use gossi\trixionary\serializer\ReferenceSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_reference' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Reference extends BaseReference implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return ReferenceSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new ReferenceSerializer();
		}

		return self::$serializer;
	}
}
