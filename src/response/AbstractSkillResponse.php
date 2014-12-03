<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Skill;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for skill, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractSkillResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $skill
	 */
	protected function filter(array $skill) {
		return FilterUtils::blacklistFilter($skill, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Skill $skill
	 */
	protected function skillToArray(Skill $skill) {
		return $this->filter($skill->toArray(TableMap::TYPE_CAMELNAME));
	}
}
