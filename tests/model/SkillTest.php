<?php
namespace gossi\trixionary\tests\model;


use gossi\trixionary\tests\samples\UnicyclingSample;

class SkillTest extends \PHPUnit_Framework_TestCase {

	/** @var UnicyclingSample */
	private $sample;

	public function setUp() {
		$this->sample = new UnicyclingSample();
	}

	public function testSpinTree() {
		$this->sample->createSpinTree();

		$spin1ftExt = $this->sample->getSpin1ftExt();

		$this->assertEquals($this->sample->getSpin1ft(), $spin1ftExt->getVariationOf());
		$this->assertEquals(4, count($spin1ftExt->getAncestors()));

		$root = $this->sample->getRootSkill();
		$this->assertEquals(7, count($root->getDescendents()));

		$spin1ft = $this->sample->getSpin1ft();
		$this->assertEquals(2, count($spin1ft->getVariations()));
	}
}