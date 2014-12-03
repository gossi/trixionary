<?php

namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Skill as BaseSkill;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\SkillTableMap;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\model\ActivityQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use gossi\trixionary\calculation\Calculator;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_skill' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Skill extends BaseSkill {
	
	const FLAG_MOVENDER = 1;
	const FLAG_MOVENDUM = 2;
	const FLAG_SIMULTANEOUS = 4;
	const FLAG_ISOLATED = 8;
	const FLAG_SAME = 16;
	const FLAG_OPPOSITE = 32;
	
	private $authors = [];

	public function toActivityObject() {
		$ao = $this->getActivityObject();
		
		if ($ao) {
			return $ao;
		}
		
		$obj = new ActivityObject();
		$obj->setType(SkillTableMap::CLASS_DEFAULT);
		$obj->setClassName(SkillTableMap::OM_CLASS);
		$obj->setDisplayName($this->getName());
		$obj->setReferenceId($this->getId());
		$obj->setVersion($this->getVersion());
		return $obj;
	}
	
	protected function getActivityObject() {
		return ActivityObjectQuery::create()
			->filterByClassName(SkillTableMap::OM_CLASS)
			->filterByType(SkillTableMap::CLASS_DEFAULT)
			->filterByDisplayName($this->getName())
			->filterByReferenceId($this->getId())
			->filterByVersion($this->getVersion())
			->findOne();
	}
	
	public function hasGroup(Group $group) {
		return $this->getGroups()->contains($group);
	}
	
	public function getAncients() {
		return $this->getSkillsRelatedByDependsId();
	}
	
	public function addAncient(Skill $skill) {
		$this->addSkillRelatedByDependsId($skill);
	}
	
	public function hasAncient(Skill $skill) {
		return $this->getAncients()->contains($skill);
	}
	
	public function getDescendents() {
		return $this->getSkillsRelatedBySkillId();
	}
	
	public function getComposites() {
		return $this->getSkillsRelatedByCompositeId();
	}
	
	public function getParts() {
		return $this->getSkillsRelatedByPartId();
	}
	
	public function addPart(Skill $skill) {
		$this->addSkillRelatedByPartId($skill);
	}
	
	public function hasPart(Skill $skill) {
		return $this->getParts()->contains($skill);
	}
	
	public function getAuthors($version = null) {
		if ($version === null) {
			$version = $this->getVersion();
		}
		
		if (isset($this->authors[$version])) {
			return $this->authors[$version];
		}
		
		$authors = [];
		$ao = $this->getActivityObject();

		if ($ao) {
			$activities = ActivityQuery::create()
				->filterByObject($ao)
				->joinActor()
				->find();
			
			foreach ($activities as $activity) {
				$authors[] = $activity->getActor();
			}
		}
		
		$this->authors[$version] = array_unique($authors);
		
		return $this->authors[$version];
	}
	
	public function getAllAuthors() {
		$authors = [];
		foreach ($this->getAllVersions() as $version) {
			$authors = array_merge($authors, $this->getAuthors($version->getVersion()));
		}
		
		return array_unique($authors);
	}
	
	public function preSave(ConnectionInterface $con = null) {
		parent::preSave($con);
		
		$calculator = Calculator::getInstance();
		$calculator->updateImportance($this);

		return true;
	}
	
	public function postSave(ConnectionInterface $con = null) {
		parent::postSave($con);
		
		SkillQuery::disableVersioning();
		$calculator = Calculator::getInstance();
		$calculator->updateImportanceOnAncients($this);
		SkillQuery::enableVersioning();
	}
	
}
