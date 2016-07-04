<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\SkillReference as BaseSkillReference;
use gossi\trixionary\serializer\SkillReferenceSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_skill_reference' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class SkillReference extends BaseSkillReference implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return SkillReferenceSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new SkillReferenceSerializer();
		}

		return self::$serializer;
	}
}
