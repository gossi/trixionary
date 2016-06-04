<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Skill as BaseSkill;
use gossi\trixionary\serializer\SkillSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_skill' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Skill extends BaseSkill implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return SkillSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new SkillSerializer();
		}

		return self::$serializer;
	}
}
