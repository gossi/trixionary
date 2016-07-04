<?php
namespace gossi\trixionary\calculation;

use gossi\trixionary\model\Lineage;
use gossi\trixionary\model\Skill;
use phootwork\collection\Map;
use phootwork\collection\Queue;
use phootwork\collection\Set;

class Calculator {

	private static $instance;

	/** @var Set */
	private $processedImportanceSkills;

	/** @var Set */
	private $processedGenerationSkills;

	/** @var Queue */
	private $queuedImportanceSkills;

	/** @var array */
	private $lineage = [];

	/** @var Set */
	private $modifiedSkills;

	/** @var Map */
	private $ancestors;

	/** @var Map */
	private $descendents;

	public function __construct() {
		$this->processedGenerationSkills = new Set();
		$this->processedImportanceSkills = new Set();
		$this->queuedImportanceSkills = new Queue();
		$this->modifiedSkills = new Set();
		$this->ancestors = new Map();
		$this->descendents = new Map();
	}

	public function reset() {
		$this->processedGenerationSkills->clear();
		$this->processedImportanceSkills->clear();
		$this->queuedImportanceSkills->clear();
		$this->modifiedSkills->clear();
		$this->ancestors->clear();
		$this->descendents->clear();
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

	/**
	 * @param Skill $skill
	 * @return Skill[]
	 */
	private function getAncestors(Skill $skill) {
		if (!$this->ancestors->has($skill->getId())) {
			$this->ancestors->set($skill->getId(), $skill->getAncestors());
		}

		return $this->ancestors->get($skill->getId());
	}

	/**
	 * @param Skill $skill
	 * @return Skill[]
	 */
	private function getDescendents(Skill $skill) {
		if (!$this->descendents->has($skill->getId())) {
			$this->descendents->set($skill->getId(), $skill->getDescendents());
		}

		return $this->descendents->get($skill->getId());
	}

	public function calculate(Skill $skill) {
		$this->calculateImportance($skill);
		$this->calculateGeneration($skill);
	}

	public function calculateImportance(Skill $skill) {
		if ($this->processedImportanceSkills->contains($skill)) {
			return;
		}

// 		$importanceDump = $skill->getImportance();
		$descendents = $this->getDescendents($skill);
		$importance = count($descendents);

		$skill->setImportance($importance);

		$this->modifiedSkills->add($skill);
		$this->processedImportanceSkills->add($skill);

// 		if ($importance !== $importanceDump || $importance == 0) {
// 			$this->queuedImportanceSkills->enqueueAll($skill->getParents());
// 		}
		$this->queuedImportanceSkills->enqueueAll($skill->getParents());

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
		$ancestors = $this->getAncestors($skill);
		if (count($ancestors)) {
			$root = $this->findRoot($ancestors);

			if ($root !== null) {
				$generation = $this->nextStep($root, $skill, $ancestors);
			}
		}

		$skill->setGeneration($generation);
		$skill->clearLineagesRelatedBySkillId();

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

		// check if target is a child
		$isChild = false;
		foreach ($children as $child) {
			if ($child == $target) {
				$isChild = true;
			}
		}

		// check if siblings have a connection to target
		if ($isChild) {
			$connectedSiblings = [];
			foreach ($children as $child) {
				$ids = array_keys($this->getDescendents($child));
				if (in_array($target->getId(), $ids)) {
					$connectedSiblings[] = $child;
				}
			}

			// make siblings the new children
			if (count($connectedSiblings) > 0) {
				$children = $connectedSiblings;
			} else {
				return $steps;
			}
		}

		// filter children to get only available skills from the pool
		// find the one with the highest importance ...
		foreach ($children as $child) {
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
			foreach ($this->getDescendents($skill) as $descendent) {
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
