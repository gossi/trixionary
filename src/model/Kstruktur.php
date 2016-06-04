<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Kstruktur as BaseKstruktur;
use gossi\trixionary\serializer\KstrukturSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_kstruktur' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Kstruktur extends BaseKstruktur implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return KstrukturSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new KstrukturSerializer();
		}

		return self::$serializer;
	}
}
