<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Video;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for video, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractVideoResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $video
	 */
	protected function filter(array $video) {
		return FilterUtils::blacklistFilter($video, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Video $video
	 */
	protected function videoToArray(Video $video) {
		return $this->filter($video->toArray(TableMap::TYPE_CAMELNAME));
	}
}
