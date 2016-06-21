<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Lineage as BaseLineage;
use gossi\trixionary\serializer\LineageSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_lineage' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Lineage extends BaseLineage implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return LineageSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new LineageSerializer();
		}

		return self::$serializer;
	}
}
