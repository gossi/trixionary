<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Video as BaseVideo;
use gossi\trixionary\serializer\VideoSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_video' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Video extends BaseVideo implements ApiModelInterface {

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
}
