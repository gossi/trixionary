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

	/**
	 * Id: 9
	 * @var Skill
	 */
	private $hopping;

	/**
	 * Id: 10
	 * @var Skill
	 */
	private $hoppingSIF;

	/**
	 * Id: 11
	 * @var Skill
	 */
	private $unispin;

	/**
	 * Id: 12
	 * @var Skill
	 */
	private $unispin180;

	/**
	 * Id: 13
	 * @var Skill
	 */
	private $unispin360;

	/**
	 * Id: 14
	 * @var Skill
	 */
	private $rollingHop;

	/**
	 * Id: 15
	 * @var Skill
	 */
	private $crankflips;

	/**
	 * Id: 16
	 * @var Skill
	 */
	private $crankflip;

	/**
	 * Id: 17
	 * @var Skill
	 */
	private $smallflip;

	/**
	 * Id: 18
	 * @var Skill
	 */
	private $doubleflip;

	/**
	 * Id: 19
	 * @var Skill
	 */
	private $hickflip;

	/**
	 * Id: 20
	 * @var Skill
	 */
	private $treyflip;

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
	public function createSkill($id, $name) {
		$skill = new Skill();
		$skill->addGroup($this->group);
		$skill->setStartPosition($this->startPosition);
		$skill->setEndPosition($this->endPosition);
		$skill->setId($id);
		$skill->setName($name);

		return $skill;
	}

	/**
	 * @return Skill
	 */
	public function getRootSkill() {
		if ($this->root === null) {
			$this->root = $this->createSkill(1, 'Riding');
		}
		return $this->root;
	}

	public function createSpinTree() {
		$root = $this->getRootSkill();

		$this->curve = $this->createSkill(2, 'Riding Curve');
		$this->curve->addSkillRelatedByParentId($root);

		$this->curveBwd = $this->createSkill(8, 'Riding Curve bwd');
		$this->curveBwd->addSkillRelatedByParentId($this->curve);
		$this->curveBwd->setVariationOf($this->curve);

		$this->spin = $this->createSkill(3, 'Spin');
		$this->spin->addSkillRelatedByParentId($this->curve);

		$this->spinBwd = $this->createSkill(7, 'Spin bwd');
		$this->spinBwd->addSkillRelatedByParentId($this->spin);
		$this->spinBwd->setVariationOf($this->spin);

		$this->spin1ft = $this->createSkill(4, 'Spin 1ft');
		$this->spin1ft->addSkillRelatedByParentId($this->spin);

		$this->spin1ftExt = $this->createSkill(5, 'Spin 1ft ext');
		$this->spin1ftExt->addSkillRelatedByParentId($this->spin1ft);
		$this->spin1ftExt->setVariationOf($this->spin1ft);

		$this->spin1ftBwd = $this->createSkill(6, 'Spin 1ft bwd');
		$this->spin1ftBwd->addSkillRelatedByParentId($this->spin1ft);
		$this->spin1ftBwd->setVariationOf($this->spin1ft);

	}

	public function createHoppingTree() {
		$root = $this->getRootSkill();

		$this->hopping = $this->createSkill(9, 'Hopping');
		$this->hopping->addSkillRelatedByParentId($root);

		$this->hoppingSIF = $this->createSkill(10, 'Hopping SIF');
		$this->hoppingSIF->addSkillRelatedByParentId($this->hopping);

		$this->unispin = $this->createSkill(11, 'Unispin');
		$this->unispin->addSkillRelatedByParentId($this->hoppingSIF);
		$this->unispin->setIsMultiple(true);

		$this->unispin180 = $this->createSkill(12, '180 Unispin');
		$this->unispin180->addSkillRelatedByParentId($this->hoppingSIF);
		$this->unispin180->setMultipleOf($this->unispin);
		$this->unispin180->setMultiplier(180);

		$this->unispin360 = $this->createSkill(13, '360 Unispin');
		$this->unispin360->addSkillRelatedByParentId($this->unispin180);
		$this->unispin360->setMultipleOf($this->unispin);
		$this->unispin360->setMultiplier(360);

		$this->rollingHop = $this->createSkill(14, 'Rolling Hop');
		$this->rollingHop->addSkillRelatedByParentId($this->hopping);

		$this->crankflips = $this->createSkill(15, 'Crankflips');
		$this->crankflips->setIsMultiple(true);

		$this->smallflip = $this->createSkill(16, 'Smallflip');
		$this->smallflip->addSkillRelatedByParentId($this->rollingHop);
		$this->smallflip->setMultipleOf($this->crankflips);
		$this->smallflip->setMultiplier(180);

		$this->crankflip = $this->createSkill(17, 'Crankflip');
		$this->crankflip->addSkillRelatedByParentId($this->rollingHop);
		$this->crankflip->setMultipleOf($this->crankflips);
		$this->crankflip->setMultiplier(360);

		$this->doubleflip = $this->createSkill(18, 'Doubleflip');
		$this->doubleflip->addSkillRelatedByParentId($this->crankflip);
		$this->doubleflip->setMultipleOf($this->crankflips);
		$this->doubleflip->setMultiplier(720);

		$this->hickflip = $this->createSkill(19, 'Hickflip');
		$this->hickflip->addSkillRelatedByParentId($this->unispin180);
		$this->hickflip->addSkillRelatedByParentId($this->crankflip);
		$this->hickflip->setIsComposite(true);
		$this->hickflip->addSkillRelatedByPartId($this->unispin180);
		$this->hickflip->addSkillRelatedByPartId($this->crankflip);

		$this->treyflip = $this->createSkill(20, 'Treyflip');
		$this->treyflip->addSkillRelatedByParentId($this->hickflip);
		$this->treyflip->addSkillRelatedByParentId($this->unispin360);
		$this->treyflip->addSkillRelatedByParentId($this->crankflip);
		$this->treyflip->setIsComposite(true);
		$this->treyflip->addSkillRelatedByPartId($this->unispin360);
		$this->treyflip->addSkillRelatedByPartId($this->crankflip);
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

	/**
	 *
	 * @return Skill
	 */
	public function getHopping() {
		return $this->hopping;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getHoppingSIF() {
		return $this->hoppingSIF;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getUnispin() {
		return $this->unispin;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getUnispin180() {
		return $this->unispin180;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getUnispin360() {
		return $this->unispin360;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getRollingHop() {
		return $this->rollingHop;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getCrankflips() {
		return $this->crankflips;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getCrankflip() {
		return $this->crankflip;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getSmallflip() {
		return $this->smallflip;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getDoubleflip() {
		return $this->doubleflip;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getHickflip() {
		return $this->hickflip;
	}

	/**
	 *
	 * @return Skill
	 */
	public function getTreyflip() {
		return $this->treyflip;
	}

}