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
	const FLAG_ATHLETE = 'null';

	/**
	 */
	const FLAG_ISOLATED = 'null';

	/**
	 */
	const FLAG_OBJECT = 'null';

	/**
	 */
	const FLAG_OPPOSITE = 'null';

	/**
	 */
	const FLAG_SAME = 'null';

	/**
	 */
	const FLAG_SIMULTANEOUS = 'null';

	/**
	 */
	private $ancestors = null;

	/**
	 */
	private $authors = null;

	/**
	 */
	private $descendents = null;

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
	 */
	public function clearAncestors() {
		$this->ancestors = null;
	}

	/**
	 */
	public function clearDescendents() {
		$this->descendents = null;
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
		$obj->setType(SkillTableMap::CLASS_DEFAULT);
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
