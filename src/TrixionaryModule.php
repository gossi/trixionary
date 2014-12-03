<?php
namespace gossi\trixionary;

use keeko\core\module\AbstractModule;
use Propel\Runtime\Propel;

/**
 * Trixionary API
 * 
 * @license MIT
 * @author gossi
 */
class TrixionaryModule extends AbstractModule {

	/**
	 */
	public function install() {
		$con = Propel::getConnection();
		
		try {
			$stmt = $con->prepare(file_get_contents(__DIR__ . '/../database/sql/keeko.sql'));
			$stmt->execute();
			
			// @TODO dev only:
			$stmt = $con->prepare(file_get_contents(__DIR__ . '/../database/sql/data.sql'));
			$stmt->execute();
		} catch (\Exception $e) {
			
		}
	}

	/**
	 */
	public function uninstall() {
	}

	/**
	 * @param mixed $from
	 * @param mixed $to
	 */
	public function update($from, $to) {
	}
}
