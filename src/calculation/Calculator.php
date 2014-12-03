<?php
namespace gossi\trixionary\calculation;

use gossi\trixionary\model\Skill;
use gossi\collection\ArrayList;
use gossi\collection\Queue;

class Calculator {
	
	private static $instance;
	private $processedImportanceSkills;
	private $queuedImportanceSkills;
	
	private function __construct() {
		$this->processedImportanceSkills = new ArrayList();
		$this->queuedImportanceSkills = new Queue();
	}

	/**
	 * @return Calculator
	 */
	public static function getInstance() {
		if (static::$instance === null) {
			static::$instance = new static();
		}
		
		return static::$instance;
	}
	
	private function addForImportanceUpdate(Skill $skill) {
		if (!$this->processedImportanceSkills->contains($skill)) {
			$this->queuedImportanceSkills->enqueue($skill);
		}
	}
	
	public function updateImportance(Skill $skill) {
		if ($this->processedImportanceSkills->contains($skill)) {
			return false;
		}

		$importanceDump = $skill->getImportance();
		
		$descendents = $this->getAllDescendents($skill);
		$importance = count(array_unique($descendents));
		
		$skill->setImportance($importance);
		
		$this->processedImportanceSkills->add($skill);

		return $importance != $importanceDump;
	}
	
	private function getAllDescendents(Skill $skill) {
		$skills = [];
		foreach ($skill->getVariations() as $variation) {
			$skills[] = $variation->getId();
			$skills = array_merge($skills, $this->getAllDescendents($variation));
		}
		
		foreach ($skill->getDescendents() as $descendent) {
			$skills[] = $descendent->getId();
			$skills = array_merge($skills, $this->getAllDescendents($descendent));
		}
		
		return $skills;
	}
	
	public function updateImportanceOnAncients(Skill $skill) {
		$ancients = $skill->getAncients();
		$variationOf = $skill->getVariationOf();
		if ($variationOf !== null) {
			$ancients->append($variationOf);
		}
		
		foreach ($ancients as $ancient) {
			if ($this->updateImportance($ancient)) {
				$this->processedImportanceSkills->add($ancient);
				$ancient->save();
				
				$this->queuedImportanceSkills->enqueueAll($ancient->getAncients());
			}
		}
		
		$todos = $this->queuedImportanceSkills->toArray();
		$this->queuedImportanceSkills->clear();
		
		foreach ($todos as $todo) {
			$this->updateImportanceOnAncients($todo);
		}
	}
}