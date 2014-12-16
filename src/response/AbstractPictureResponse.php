<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Picture;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for picture, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractPictureResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $picture
	 */
	protected function filter(array $picture) {
		return FilterUtils::blacklistFilter($picture, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Picture $picture
	 */
	protected function pictureToArray(Picture $picture) {
		return $this->filter($picture->toArray(TableMap::TYPE_CAMELNAME));
	}
}
