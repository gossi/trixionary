<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\SkillVersion;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for kk_trixionary_skill_version, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractKkTrixionarySkillVersionResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $kk_trixionary_skill_version
	 */
	protected function filter(array $kk_trixionary_skill_version) {
		return FilterUtils::blacklistFilter($kk_trixionary_skill_version, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param SkillVersion $kk_trixionary_skill_version
	 */
	protected function kk_trixionary_skill_versionToArray(SkillVersion $kk_trixionary_skill_version) {
		return $this->filter($kk_trixionary_skill_version->toArray(TableMap::TYPE_CAMELNAME));
	}
}
