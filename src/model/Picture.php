<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Picture as BasePicture;
use gossi\trixionary\serializer\PictureSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_picture' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Picture extends BasePicture implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return PictureSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new PictureSerializer();
		}

		return self::$serializer;
	}
}
