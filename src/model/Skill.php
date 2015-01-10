<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Skill as BaseSkill;
use keeko\core\model\ActivityObject;
use gossi\trixionary\model\Map\SkillTableMap;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\model\ActivityQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use gossi\trixionary\calculation\Calculator;
use gossi\collection\Map;
use keeko\core\utils\ActivityObjectInterface;

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
class Skill extends BaseSkill implements ActivityObjectInterface {
	
	const FLAG_MOVENDER = 1;
	const FLAG_MOVENDUM = 2;
	const FLAG_SIMULTANEOUS = 4;
	const FLAG_ISOLATED = 8;
	const FLAG_SAME = 16;
	const FLAG_OPPOSITE = 32;
	
	private $authors = [];
	private $ancestors = null;
	private $descendents = null;
	
	private static $isSaving = false;

	public function toActivityObject() {
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

	public function setVariationOf(Skill $v = null) {
		parent::setVariationOf($v);
		if ($v !== null) {
			$this->addParent($v);
		}
	}
	
	public function setVariationOfId($v = null) {
		parent::setVariationOfId($v);
		if ($v !== null) {
			$this->addParent($this->getVariationOf());
		}
	}
	
	public function isTransition() {
		return $this->getStartPositionId() != $this->getEndPositionId();
	}
	
	public function hasGroup(Group $group) {
		return $this->getGroups()->contains($group);
	}
	
	public function deleteGroups() {
		SkillGroupQuery::create()->filterBySkillId($this->getId())->delete();
	}
	
	public function getParents() {
		return $this->getSkillsRelatedByDependsId();
	}
	
	public function addParent(Skill $skill) {
		$this->addSkillRelatedByDependsId($skill);
	}
	
	public function hasParent(Skill $skill) {
		return $this->getParents()->contains($skill);
	}
	
	public function deleteParents() {
		SkillDependencyQuery::create()->filterBySkillId($this->getId())->delete();
	}
	
	public function getAncestors() {
		if ($this->ancestors === null) {
			$this->ancestors = new Map();
			
			$add = function (Skill $skill) {
				if (!$skill->isTransition()) {
					$this->ancestors->set($skill->getId(), $skill);
					$this->ancestors->setAll($skill->getAncestors());
				}
			};
			
			foreach ($this->getParents() as $parent) {
				$add($parent);
			}
			
			$variationOf = $this->getVariationOf();
			if ($variationOf !== null) {
				$add($variationOf);
			}
		}

		return $this->ancestors->toArray();
	}
	
	public function clearAncestors() {
		$this->ancestors = null;
	}
	
	public function getChildren() {
		return $this->getSkillsRelatedBySkillId();
	}
	
	public function getDescendents() {
		if ($this->descendents === null) {
			$this->descendents = new Map();
			
			$add = function (Skill $skill) {
				if (!$skill->isTransition()) {
					$this->descendents->set($skill->getId(), $skill);
					$this->descendents->setAll($skill->getDescendents());
				}
			};
			
			foreach ($this->getVariations() as $variation) {
				$add($variation);
			}

			foreach ($this->getChildren() as $child) {
				$add($child);
			}
		}
		
		return $this->descendents->toArray();
	}
	
	public function clearDescendents() {
		$this->descendents = null;
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
	
	public function deleteParts() {
		SkillPartQuery::create()->filterByCompositeId($this->getId())->delete();
	} 
	
	public function postSave(ConnectionInterface $con = null) {
		parent::postSave($con);
		
		if (static::$isSaving) {
			return;
		}
		
		static::$isSaving = true;

		SkillQuery::disableVersioning();
		$calculator = Calculator::getInstance();
		$calculator->updateImportance($this);
		$calculator->updateOutstandingImportance();
		$calculator->updateGeneration($this);
		$calculator->updateOutstandingGeneration();
		SkillQuery::enableVersioning();
		
		static::$isSaving = false;
	}

	public function getKstrukturs() {
		return $this->getKstruktursRelatedBySkillIdJoinStructureNode();
	}

	public function getFunctionPhases() {
		return $this->getFunctionPhasesRelatedBySkillIdJoinStructureNode();
	}

}
