<?php
namespace gossi\trixionary\tests\calculator;

use gossi\trixionary\calculation\Calculator;
use gossi\trixionary\tests\samples\UnicyclingSample;

class CalculatorTest extends \PHPUnit_Framework_TestCase {

	/** @var UnicyclingSample */
	private $sample;

	public function setUp() {
		$this->sample = new UnicyclingSample();
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
		$ids = [];
		foreach ($spin1ft->getLineages() as $lineage) {
			$ids []= $lineage->getAncestor()->getId();
		}

		$this->assertEquals([1, 2, 3], $ids);
	}
}