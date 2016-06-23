<?php
namespace gossi\trixionary\tests\calculator;

use gossi\trixionary\calculation\Calculator;
use gossi\trixionary\tests\samples\UnicyclingSample;
use gossi\trixionary\model\Skill;

class CalculatorTest extends \PHPUnit_Framework_TestCase {

	/** @var UnicyclingSample */
	private $sample;

	public function setUp() {
		$this->sample = new UnicyclingSample();
	}

	/**
	 * @param Skill $skill
	 * @return array
	 */
	private function getLineageIds(Skill $skill) {
		$ids = [];
		foreach ($skill->getLineages() as $lineage) {
			$ids []= $lineage->getAncestor()->getId();
		}
		return $ids;
	}

	public function testSpinTree() {
		$this->sample->createSpinTree();
		$spin1ft = $this->sample->getSpin1ft();
		$root = $this->sample->getRootSkill();

		$calculator = new Calculator();
		$calculator->calculate($spin1ft);

		// importance
		$this->assertEquals(7, $root->getImportance());
		$this->assertEquals(2, $spin1ft->getImportance());

		// generation
		$this->assertEquals(1, $root->getGeneration());
		$this->assertEquals(4, $spin1ft->getGeneration());

		// lineage
		$this->assertEquals([1, 2, 3], $this->getLineageIds($spin1ft));
	}

	public function testHoppingTree() {
		$this->sample->createHoppingTree();
		$treyflip = $this->sample->getTreyflip();

		$calculator = new Calculator();
		$calculator->calculate($treyflip);

		// hopping SIF descendents
		$ids = array_keys($this->sample->getHoppingSIF()->getDescendents());
		$this->assertEquals([12, 13, 20, 19], $ids);

		// test importance
		$this->assertEquals(0, $treyflip->getImportance());
		$this->assertEquals(1, $this->sample->getUnispin360()->getImportance());
		$this->assertEquals(3, $this->sample->getUnispin180()->getImportance());
		$this->assertEquals(4, $this->sample->getHoppingSIF()->getImportance());

		$this->assertEquals(1, $this->sample->getHickflip()->getImportance());
		$this->assertEquals(0, $this->sample->getDoubleflip()->getImportance());
		$this->assertEquals(3, $this->sample->getCrankflip()->getImportance());
		$this->assertEquals(0, $this->sample->getSmallflip()->getImportance());
		$this->assertEquals(5, $this->sample->getRollingHop()->getImportance());
		$this->assertEquals(9, $this->sample->getHopping()->getImportance());
		$this->assertEquals(10, $this->sample->getRootSkill()->getImportance());

		// test generation
		$this->assertEquals(1, $this->sample->getRootSkill()->getGeneration());
		$this->assertEquals(2, $this->sample->getHopping()->getGeneration());

		$this->assertEquals(3, $this->sample->getHoppingSIF()->getGeneration());
		$this->assertEquals(4, $this->sample->getUnispin180()->getGeneration());
		$this->assertEquals(5, $this->sample->getUnispin360()->getGeneration());

		$this->assertEquals(3, $this->sample->getRollingHop()->getGeneration());
		$this->assertEquals(4, $this->sample->getCrankflip()->getGeneration());
		$this->assertEquals(4, $this->sample->getSmallflip()->getGeneration());
		$this->assertEquals(5, $this->sample->getHickflip()->getGeneration());
		$this->assertEquals(6, $treyflip->getGeneration());

		// lineage for treyflip
		$this->assertEquals([1, 9, 14, 17, 19], $this->getLineageIds($treyflip));
	}

	public function testInsertAerialIntoHoppingTree() {
		$this->sample->createHoppingTree();
		$treyflip = $this->sample->getTreyflip();
		$unispin180 = $this->sample->getUnispin180();

		// initial calculation
		$calculator = new Calculator();
		$calculator->calculate($treyflip);

		// lineage for 180 unispin
		$this->assertEquals([1, 9, 10], $this->getLineageIds($unispin180));

		// add aerial
		$aerial = $this->sample->createSkill(1000, 'Aerial');
		$aerial->addSkillRelatedByParentId($this->sample->getHoppingSIF());

		$calculator->reset();
		$calculator->calculate($aerial);

		// assert aerial
		$this->assertEquals([1, 9, 10], $this->getLineageIds($aerial));
		$this->assertEquals(4, $aerial->getGeneration());
		$this->assertEquals(0, $aerial->getImportance());

		// add aerial as parent for 180 unispin
		$unispin180->clearSkillsRelatedByParentId();
		$unispin180->addSkillRelatedByParentId($aerial);

		$calculator->reset();
		$calculator->calculate($unispin180);

		// assert 180 unispin
		$this->assertEquals(5, $unispin180->getGeneration());
		$this->assertEquals([1, 9, 10, 1000], $this->getLineageIds($unispin180));

		// assert treyflip
		$this->assertEquals(7, $treyflip->getGeneration());
		$this->assertEquals([1, 9, 10, 1000, 12, 13], $this->getLineageIds($treyflip));
	}


}