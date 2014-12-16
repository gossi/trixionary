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
	private $steps = [];
	
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
		
		$descendents = $skill->getDescendents();
		$importance = count($descendents);
		
		$skill->setImportance($importance);
		$skill->save();
		
		$this->processedImportanceSkills->add($skill);
		
		if ($importance !== $importanceDump) {
			$this->queuedImportanceSkills->enqueueAll($skill->getParents());
		}
	}
	
	public function updateOutstandingImportance() {
		if ($this->queuedImportanceSkills->size() == 0) {
			return;
		}
			
		$skills = $this->queuedImportanceSkills->toArray();
		$this->queuedImportanceSkills->clear();
		
		foreach ($skills as $skill) {
			$this->updateImportance($skill);
		}

		$this->updateOutstandingImportance();
	}
	
	public function updateGeneration(Skill $skill) {
		if ($this->processedGenerationSkills->contains($skill)) {
			return false;
		}
		$this->steps = [];
		$generation = 1;
		$ancestors = $skill->getAncestors();
		if (count($ancestors)) {
			$root = $this->findRoot($ancestors);
			
			if ($root !== null) {
				$generation = $this->nextStep($root, $skill, $ancestors);
			}
		}
		
		$skill->setGeneration($generation);
		$skill->setGenerationIds(json_encode($this->steps));
		$skill->save();
		$this->processedGenerationSkills->add($skill);
		
		return true;
	}
	
	/**
	 * 
	 * @param Skill $skill
	 * @param Skill $target
	 * @param Skill[] $pool
	 * @param int $steps
	 */
	private function nextStep(Skill $skill, Skill $target, array $pool, $steps = 1) {
		$this->steps[] = $skill->getId();
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
	
	private function getDescendentsFromImportanceChangedSkills() {
		$descendents = [];
		foreach ($this->processedImportanceSkills as $skill) {
			$descendents[$skill->getId()] = $skill;
			foreach ($skill->getDescendents() as $descendent) {
				$descendents[$descendent->getId()] = $descendent;
			}
		}

		return $descendents;
	}
	
	public function updateOutstandingGeneration() {
		$skills = $this->getDescendentsFromImportanceChangedSkills();
		
		foreach ($skills as $skill) {
			$this->updateGeneration($skill);
		}
	}
}