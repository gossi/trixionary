<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\FunctionPhaseEvent;
use gossi\trixionary\model\FunctionPhaseQuery;
use gossi\trixionary\model\FunctionPhase;
use gossi\trixionary\model\SkillQuery;
use keeko\framework\domain\payload\Created;
use keeko\framework\domain\payload\Deleted;
use keeko\framework\domain\payload\Found;
use keeko\framework\domain\payload\NotDeleted;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\domain\payload\NotUpdated;
use keeko\framework\domain\payload\NotValid;
use keeko\framework\domain\payload\PayloadInterface;
use keeko\framework\domain\payload\Updated;
use keeko\framework\service\ServiceContainer;
use keeko\framework\utils\NameUtils;
use keeko\framework\utils\Parameters;
use phootwork\collection\Map;

/**
 */
trait FunctionPhaseDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds RootSkills to FunctionPhase
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}
		 
		// update
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->addRootSkill($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_ROOT_SKILLS_ADD, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(FunctionPhaseEvent::POST_ROOT_SKILLS_ADD, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new FunctionPhase with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = FunctionPhase::getSerializer();
		$model = $serializer->hydrate(new FunctionPhase(), $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_CREATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
		$model->save();
		$dispatcher->dispatch(FunctionPhaseEvent::POST_CREATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a FunctionPhase with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		// delete
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$dispatcher->dispatch(FunctionPhaseEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete FunctionPhase']);
	}

	/**
	 * Returns a paginated result
	 * 
	 * @param Parameters $params
	 * @return PayloadInterface
	 */
	public function paginate(Parameters $params) {
		$sysPrefs = $this->getServiceContainer()->getPreferenceLoader()->getSystemPreferences();
		$defaultSize = $sysPrefs->getPaginationSize();
		$page = $params->getPage('number');
		$size = $params->getPage('size', $defaultSize);

		$query = FunctionPhaseQuery::create();

		// sorting
		$sort = $params->getSort(FunctionPhase::getSerializer()->getSortFields());
		foreach ($sort as $field => $order) {
			$method = 'orderBy' . NameUtils::toStudlyCase($field);
			$query->$method($order);
		}

		// filtering
		$filter = $params->getFilter();
		if (!empty($filter)) {
			$this->applyFilter($query, $filter);
		}

		// paginate
		$model = $query->paginate($page, $size);

		// run response
		return new Found(['model' => $model]);
	}

	/**
	 * Returns one FunctionPhase with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes RootSkills from FunctionPhase
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		// remove them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->removeRootSkill($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_ROOT_SKILLS_REMOVE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(FunctionPhaseEvent::POST_ROOT_SKILLS_REMOVE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the Skill id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setSkillId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		// update
		if ($model->getSkillId() !== $relatedId) {
			$model->setSkillId($relatedId);

			$event = new FunctionPhaseEvent($model);
			$dispatcher = $this->getServiceContainer()->getDispatcher();
			$dispatcher->dispatch(FunctionPhaseEvent::PRE_SKILL_UPDATE, $event);
			$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
			$model->save();
			$dispatcher->dispatch(FunctionPhaseEvent::POST_SKILL_UPDATE, $event);
			$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);
			
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a FunctionPhase with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		// hydrate
		$serializer = FunctionPhase::getSerializer();
		$model = $serializer->hydrate($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_UPDATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(FunctionPhaseEvent::POST_UPDATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates RootSkills on FunctionPhase
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'FunctionPhase not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterByFunctionPhaseRoot($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->addRootSkill($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new FunctionPhaseEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_ROOT_SKILLS_UPDATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(FunctionPhaseEvent::POST_ROOT_SKILLS_UPDATE, $event);
		$dispatcher->dispatch(FunctionPhaseEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * @param mixed $query
	 * @param mixed $filter
	 * @return void
	 */
	protected function applyFilter($query, $filter) {
		foreach ($filter as $column => $value) {
			$pos = strpos($column, '.');
			if ($pos !== false) {
				$rel = NameUtils::toStudlyCase(substr($column, 0, $pos));
				$col = substr($column, $pos + 1);
				$method = 'use' . $rel . 'Query';
				if (method_exists($query, $method)) {
					$sub = $query->$method();
					$this->applyFilter($sub, [$col => $value]);
					$sub->endUse();
				}
			} else {
				$method = 'filterBy' . NameUtils::toStudlyCase($column);
				if (method_exists($query, $method)) {
					$query->$method($value);
				}
			}
		}
	}

	/**
	 * Returns one FunctionPhase with the given id from cache
	 * 
	 * @param mixed $id
	 * @return FunctionPhase|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = FunctionPhaseQuery::create()->findOneById($id);
		$this->pool->set($id, $model);

		return $model;
	}

	/**
	 * Returns the service container
	 * 
	 * @return ServiceContainer
	 */
	abstract protected function getServiceContainer();
}