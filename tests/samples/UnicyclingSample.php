<?php
namespace gossi\trixionary\tests\samples;

use gossi\trixionary\model\Sport;
use gossi\trixionary\model\Group;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Skill;

class UnicyclingSample {

	private $sport;
	/**
	 * Id: 1
	 * @var Skill
	 */
	private $root;
	private $group;
	private $startPosition;
	private $endPosition;

	/**
	 * Id: 2
	 * @var Skill
	 */
	private $curve;

	/**
	 * Id: 8
	 * @var Skill
	 */
	private $curveBwd;

	/**
	 * Id: 3
	 * @var Skill
	 */
	private $spin;

	/**
	 * Id: 7
	 * @var Skill
	 */
	private $spinBwd;

	/**
	 * Id: 4
	 * @var Skill
	 */
	private $spin1ft;

	/**
	 * Id: 5
	 * @var Skill
	 */
	private $spin1ftExt;

	/**
	 * Id: 6
	 * @var Skill
	 */
	private $spin1ftBwd;

	public function __construct() {
		$this->sport = new Sport();

		$this->group = new Group();
		$this->group->setSport($this->sport);

		$this->startPosition = new Position();
		$this->startPosition->setSport($this->sport);
		$this->endPosition = new Position();
		$this->endPosition->setSport($this->sport);
	}

	/**
	 * @return Sport
	 */
	public function getSport() {
		return $this->sport;
	}

	/**
	 * @return Group
	 */
	public function getGroup() {
		return $this->group;
	}

	/**
	 * @return Position
	 */
	public function getStartPosition() {
		return $this->startPosition;
	}

	/**
	 * @return Position
	 */
	public function getEndPosition() {
		return $this->endPosition;
	}

	/**
	 * @return Skill
	 */
	private function createSkill() {
		$skill = new Skill();
		$skill->addGroup($this->group);
		$skill->setStartPosition($this->startPosition);
		$skill->setEndPosition($this->endPosition);

		return $skill;
	}

	/**
	 * @return Skill
	 */
	public function getRootSkill() {
		if ($this->root === null) {
			$this->root = $this->createSkill();
			$this->root->setName('Riding');
			$this->root->setId(1);
		}
		return $this->root;
	}

	public function createSpinTree() {
		$root = $this->getRootSkill();

		$this->curve = $this->createSkill();
		$this->curve->setId(2);
		$this->curve->setName('Riding Curve');
		$this->curve->addSkillRelatedByParentId($root);

		$this->curveBwd = $this->createSkill();
		$this->curveBwd->setId(8);
		$this->curveBwd->setName('Riding Curve bwd');
		$this->curveBwd->addSkillRelatedByParentId($this->curve);
		$this->curveBwd->setVariationOf($this->curve);

		$this->spin = $this->createSkill();
		$this->spin->setId(3);
		$this->spin->setName('Spin');
		$this->spin->addSkillRelatedByParentId($this->curve);

		$this->spinBwd = $this->createSkill();
		$this->spinBwd->setId(7);
		$this->spinBwd->setName('Spin bwd');
		$this->spinBwd->addSkillRelatedByParentId($this->spin);
		$this->spinBwd->setVariationOf($this->spin);

		$this->spin1ft = $this->createSkill();
		$this->spin1ft->setId(4);
		$this->spin1ft->setName('Spin 1ft');
		$this->spin1ft->addSkillRelatedByParentId($this->spin);

		$this->spin1ftExt = $this->createSkill();
		$this->spin1ftExt->setId(5);
		$this->spin1ftExt->setName('Spin 1ft ext');
		$this->spin1ftExt->addSkillRelatedByParentId($this->spin1ft);
		$this->spin1ftExt->setVariationOf($this->spin1ft);

		$this->spin1ftBwd = $this->createSkill();
		$this->spin1ftBwd->setId(6);
		$this->spin1ftBwd->setName('Spin 1ft bwd');
		$this->spin1ftBwd->addSkillRelatedByParentId($this->spin1ft);
		$this->spin1ftBwd->setVariationOf($this->spin1ft);

	}

	/**
	 * @return Skill
	 */
	public function getCurve() {
		return $this->curve;
	}

	/**
	 * @return Skill
	 */
	public function getCurveBwd() {
		return $this->curveBwd;
	}

	/**
	 * @return Skill
	 */
	public function getSpin() {
		return $this->spin;
	}

	/**
	 * @return Skill
	 */
	public function getSpinBwd() {
		return $this->spinBwd;
	}

	/**
	 * @return Skill
	 */
	public function getSpin1ft() {
		return $this->spin1ft;
	}

	/**
	 * @return Skill
	 */
	public function getSpin1ftExt() {
		return $this->spin1ftExt;
	}

	/**
	 * @return Skill
	 */
	public function getSpin1ftBwd() {
		return $this->spin1ftBwd;
	}
}