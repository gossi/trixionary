<?php
namespace gossi\trixionary\calculation;

use gossi\trixionary\model\Lineage;
use gossi\trixionary\model\Skill;
use phootwork\collection\Queue;
use phootwork\collection\Set;

class Calculator {

	private static $instance;

	private $processedImportanceSkills;
	private $processedGenerationSkills;
	private $queuedImportanceSkills;
	private $lineage = [];
	private $modifiedSkills;

	public function __construct() {
		$this->processedGenerationSkills = new Set();
		$this->processedImportanceSkills = new Set();
		$this->queuedImportanceSkills = new Queue();
		$this->modifiedSkills = new Set();
	}

	/**
	 * @return Set
	 */
	public function getModifiedSkills() {
		return $this->modifiedSkills;
	}

	/**
	 * @return Set
	 */
	public function getModifiedGenerationSkills() {
		return $this->processedGenerationSkills;
	}

	public function calculate(Skill $skill) {
		$this->calculateImportance($skill);
		$this->calculateGeneration($skill);
	}

	public function calculateImportance(Skill $skill) {
		if ($this->processedImportanceSkills->contains($skill)) {
			return;
		}

		$importanceDump = $skill->getImportance();
		$descendents = $skill->getDescendents();
		$importance = count($descendents);

		$skill->setImportance($importance);

		$this->modifiedSkills->add($skill);
		$this->processedImportanceSkills->add($skill);

		if ($importance !== $importanceDump || $importance == 0) {
			$this->queuedImportanceSkills->enqueueAll($skill->getParents());
		}

		$this->processImportanceQueue();
	}

	private function processImportanceQueue() {
		if ($this->queuedImportanceSkills->size() == 0) {
			return;
		}

		$skills = clone $this->queuedImportanceSkills;
		$this->queuedImportanceSkills->clear();

		foreach ($skills as $skill) {
			$this->calculateImportance($skill);
		}

		$this->processImportanceQueue();
	}

	public function calculateGeneration(Skill $skill) {
		if ($this->processedGenerationSkills->contains($skill)) {
			return;
		}

		$this->lineage = [];
		$generation = 1;
		$ancestors = $skill->getAncestors();
		if (count($ancestors)) {
			$root = $this->findRoot($ancestors);

			if ($root !== null) {
				$generation = $this->nextStep($root, $skill, $ancestors);
			}
		}

		$skill->setGeneration($generation);

		// set generations
		foreach ($this->lineage as $pos => $ancestor) {
			$lin = new Lineage();
			$lin->setSkill($skill);
			$lin->setAncestor($ancestor);
			$lin->setPosition($pos);
		}

		$this->modifiedSkills->add($skill);
		$this->processedGenerationSkills->add($skill);
		$this->processGenerationQueue();
	}

	/**
	 *
	 * @param Skill $skill
	 * @param Skill $target
	 * @param Skill[] $pool
	 * @param int $steps
	 */
	private function nextStep(Skill $skill, Skill $target, array $pool, $steps = 1) {
		$this->lineage[$steps] = $skill;
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
	private function findRoot($ancestors) {
		$root = null;
		foreach ($ancestors as $ancestor) {
			if (count($ancestor->getParents()) == 0) {
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

	private function processGenerationQueue() {
		$skills = $this->getDescendentsFromImportanceChangedSkills();

		foreach ($skills as $skill) {
			$this->calculateGeneration($skill);
		}
	}
}