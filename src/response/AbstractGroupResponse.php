<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Group;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for group, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractGroupResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $group
	 */
	protected function filter(array $group) {
		return FilterUtils::blacklistFilter($group, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Group $group
	 */
	protected function groupToArray(Group $group) {
		return $this->filter($group->toArray(TableMap::TYPE_CAMELNAME));
	}
}
