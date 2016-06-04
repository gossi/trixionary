<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\SkillVersion as BaseSkillVersion;
use gossi\trixionary\serializer\SkillVersionSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_kk_trixionary_skill_version' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class SkillVersion extends BaseSkillVersion implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return SkillVersionSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new SkillVersionSerializer();
		}

		return self::$serializer;
	}
}
