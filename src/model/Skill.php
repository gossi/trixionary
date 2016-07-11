<?php
namespace gossi\trixionary\model;

use gossi\trixionary\model\Base\Skill as BaseSkill;
use gossi\trixionary\model\Map\SkillTableMap;
use gossi\trixionary\serializer\SkillSerializer;
use keeko\core\model\ActivityObject;
use keeko\core\model\ActivityObjectQuery;
use keeko\core\model\ActivityQuery;
use keeko\core\model\User;
use keeko\framework\model\ActivityObjectInterface;
use keeko\framework\model\ApiModelInterface;
use phootwork\collection\Map;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'kk_trixionary_skill' table.
 * 
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Skill extends BaseSkill implements ApiModelInterface, ActivityObjectInterface {

	/**
	 */
	const FLAG_ATHLETE = 1;

	/**
	 */
	const FLAG_ISOLATED = 8;

	/**
	 */
	const FLAG_OBJECT = 2;

	/**
	 */
	const FLAG_OPPOSITE = 32;

	/**
	 */
	const FLAG_SAME = 16;

	/**
	 */
	const FLAG_SIMULTANEOUS = 4;

	/**
	 */
	private $authors = null;

	/**
	 */
	private static $serializer;

	/**
	 * @return SkillSerializer
	 */
	public static function getSerializer() {
		if (self::$serializer === null) {
			self::$serializer = new SkillSerializer();
		}

		return self::$serializer;
	}

	/**
	 * @return User[]
	 */
	public function getAllAuthors() {
		$authors = array();
		foreach ($this->getAllVersions() as $version) {
		    $authors = array_merge($authors, $this->getAuthors($version->getVersion()));
		}
		return array_unique($authors);
	}

	/**
	 * @return Skill[]
	 */
	public function getAncestors() {
		$ancestors = new Map();
		$add = function (Skill $skill) use($ancestors) {
		    if ($skill->isMultiple() || $skill->isTransition()) {
		        return;
		    }
		    $ancestors->set($skill->getId(), $skill);
		    $ancestors->setAll($skill->getAncestors());
		};
		foreach ($this->getParents() as $parent) {
		    $add($parent);
		}
		$variationOf = $this->getVariationOf();
		if ($variationOf !== null) {
		    $add($variationOf);
		}
		return $ancestors->toArray();
	}

	/**
	 * @param mixed $version
	 * @return User[]
	 */
	public function getAuthors($version = null) {
		if ($version === null) {
		    $version = $this->getVersion();
		}
		if (isset($this->authors[$version])) {
		    return $this->authors[$version];
		}
		$authors = array();
		$ao = $this->getActivityObject();
		if ($ao) {
		    $activities = ActivityQuery::create()->filterByObject($ao)->joinActor()->find();
		    foreach ($activities as $activity) {
		        $authors[] = $activity->getActor();
		    }
		}
		$this->authors[$version] = array_unique($authors);
		return $this->authors[$version];
	}

	/**
	 * @param Criteria $criteria
	 * @param ConnectionInterface $con
	 * @return Skill[]
	 */
	public function getChildren(Criteria $criteria = null, ConnectionInterface $con = null) {
		return $this->getSkillsRelatedByDependencyId();
	}

	/**
	 * @param Criteria $criteria
	 * @param ConnectionInterface $con
	 * @return Skill[]
	 */
	public function getComposites(Criteria $criteria = null, ConnectionInterface $con = null) {
		return $this->getSkillsRelatedByCompositeId();
	}

	/**
	 * @return Skill[]
	 */
	public function getDescendents() {
		$descendents = new Map();
		$add = function (Skill $skill) use($descendents) {
		    if ($skill->isMultiple() || $skill->isTransition()) {
		        return;
		    }
		    $descendents->set($skill->getId(), $skill);
		    $descendents->setAll($skill->getDescendents());
		};
		foreach ($this->getVariations() as $variation) {
		    $add($variation);
		}
		foreach ($this->getChildren() as $child) {
		    $add($child);
		}
		return $descendents->toArray();
	}

	/**
	 * @return Lineage[]
	 */
	public function getLineages() {
		return $this->getLineagesRelatedBySkillId();
	}

	/**
	 * @param Criteria $criteria
	 * @param ConnectionInterface $con
	 * @return ObjectCollection|Skill[] List of ChildSkill objects
	 */
	public function getParents(Criteria $criteria = null, ConnectionInterface $con = null) {
		return $this->getSkillsRelatedByParentId();
	}

	/**
	 * @param Criteria $criteria
	 * @param ConnectionInterface $con
	 * @return Skill[]
	 */
	public function getParts(Criteria $criteria = null, ConnectionInterface $con = null) {
		return $this->getSkillsRelatedByPartId();
	}

	/**
	 */
	public function isTransition() {
		return $this->getStartPositionId() != $this->getEndPositionId();
	}

	/**
	 * @param Skill $v
	 */
	public function setVariationOf(Skill $v = null) {
		parent::setVariationOf($v);
		$this->addSkillRelatedByParentId($v);
	}

	/**
	 */
	public function toActivityObject() {
		$obj = new ActivityObject();
		$obj->setType(ActivityObject::TYPE_SKILL);
		$obj->setClassName(SkillTableMap::OM_CLASS);
		$obj->setDisplayName($this->getName());
		$obj->setReferenceId($this->getId());
		$obj->setVersion($this->getVersion());
		return $obj;
	}

	/**
	 */
	protected function getActivityObject() {
		return ActivityObjectQuery::create()->filterByClassName(SkillTableMap::OM_CLASS)->filterByType(SkillTableMap::CLASS_DEFAULT)->filterByDisplayName($this->getName())->filterByReferenceId($this->getId())->filterByVersion($this->getVersion())->findOne();
	}
}
