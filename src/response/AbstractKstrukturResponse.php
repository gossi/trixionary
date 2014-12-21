<?php
namespace gossi\trixionary\response;

use gossi\trixionary\model\Kstruktur;
use keeko\core\action\AbstractResponse;
use keeko\core\utils\FilterUtils;
use Propel\Runtime\Map\TableMap;

/**
 * Abstract Response for kstruktur, containing filter functionality.
 * 
 * This class is generated automatically, your changes may be overwritten - take care.
 * 
 * @author gossi
 */
abstract class AbstractKstrukturResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param array $kstruktur
	 */
	protected function filter(array $kstruktur) {
		return FilterUtils::blacklistFilter($kstruktur, []);
	}

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Kstruktur $kstruktur
	 */
	protected function kstrukturToArray(Kstruktur $kstruktur) {
		return $this->filter($kstruktur->toArray(TableMap::TYPE_CAMELNAME));
	}
}
