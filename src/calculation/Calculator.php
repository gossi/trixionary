<?php
namespace gossi\trixionary\calculation;

use gossi\trixionary\model\Skill;
use gossi\collection\ArrayList;
use gossi\collection\Queue;

class Calculator {
	
	private static $instance;
	private $processedImportanceSkills;
	private $processedGenerationSkills;
	private $queuedImportanceSkills;
	
	private function __construct() {
		$this->processedGenerationSkills = new ArrayList();
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
		
		foreach ($skill->getChildren() as $child) {
			if (!$child->isTransition()) {
				$skills[] = $child->getId();
				$skills = array_merge($skills, $this->getAllDescendents($child));
			}
		}
		
		return $skills;
	}
	
	public function updateImportanceOnAncestors(Skill $skill) {
		$ancestors = $skill->getParents();
		
		foreach ($ancestors as $ancestor) {
			if ($this->updateImportance($ancestor)) {
				$this->updateGeneration($ancestor);
				$this->processedImportanceSkills->add($ancestor);
				$ancestor->save();
				
				$this->queuedImportanceSkills->enqueueAll($ancestor->getParents());
			}
		}
		
		$todos = $this->queuedImportanceSkills->toArray();
		$this->queuedImportanceSkills->clear();
		
		foreach ($todos as $todo) {
			$this->updateImportanceOnAncestors($todo);
		}
	}
	
	public function updateGeneration(Skill $skill) {
		if ($this->processedGenerationSkills->contains($skill)) {
			return;
		}
		$generation = 1;
		$ancestors = $skill->getAncestors();
		if (count($ancestors)) {
			$root = $this->findRoot($ancestors);
			
			if ($root !== null) {
				$generation = $this->nextStep($root, $skill, $ancestors);
			}
		}
		
		$skill->setGeneration($generation);
		$this->processedGenerationSkills->add($skill);
	}
	
	/**
	 * 
	 * @param Skill $skill
	 * @param Skill $target
	 * @param Skill[] $pool
	 * @param number $steps
	 */
	public function nextStep(Skill $skill, Skill $target, array $pool, $steps = 1) {
		if ($skill == $target) {
			return $steps;
		}
		$children = $skill->getChildren();
		$max = 0;
		$next = null;
		$steps++;
		
		// filter children to get only available skills from the pool
		// find the one with the highest importance ...
		foreach ($children as $child) {
			if ($child == $target) {
				return $steps;
			}
			if (in_array($child, $pool)) {
				$importance = $child->getImportance();
				if ($importance > $max) {
					$max = $importance;
					$next = $child;
				}
			}
		}
		
		// ... and continue
		if ($next !== null) {
			return $this->nextStep($next, $target, $pool, $steps);
		}
		
		return $steps;
	}
	
	/**
	 * @param Skill[] $ancestors
	 * @return Skill|null
	 */
	private function findRoot(array $ancestors) {
		$root = null;
		foreach ($ancestors as $ancestor) {
			if (count($ancestor->getAncestors()) == 0) {
				$root = $ancestor;
			}
		}
		return $root;
	}
}