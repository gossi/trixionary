<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\FunctionPhase as BaseFunctionPhase;
use gossi\trixionary\serializer\FunctionPhaseSerializer;
use keeko\framework\model\ApiModelInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_function_phase' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class FunctionPhase extends BaseFunctionPhase implements ApiModelInterface {

	/**
	 */
	private static $serializer;

	/**
	 * @return FunctionPhaseSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new FunctionPhaseSerializer();
		}

		return self::$serializer;
	}
}
