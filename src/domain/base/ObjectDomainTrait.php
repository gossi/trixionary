<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\ObjectEvent;
use gossi\trixionary\model\ObjectQuery;
use gossi\trixionary\model\Object;
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
trait ObjectDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds Skills to Object
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// update
		$serializer = Object::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('skills');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_SKILLS_ADD, $event);
		$this->dispatch(ObjectEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(ObjectEvent::POST_SKILLS_ADD, $event);
		$this->dispatch(ObjectEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new Object with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Object::getSerializer();
		$model = $serializer->hydrate(new Object(), $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_CREATE, $event);
		$this->dispatch(ObjectEvent::PRE_SAVE, $event);
		$model->save();
		$this->dispatch(ObjectEvent::POST_CREATE, $event);
		$this->dispatch(ObjectEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Object with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// delete
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(ObjectEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Object']);
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

		$query = ObjectQuery::create();

		// sorting
		$sort = $params->getSort(Object::getSerializer()->getSortFields());
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
	 * Returns one Object with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes Skills from Object
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// remove them
		$serializer = Object::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('skills');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_SKILLS_REMOVE, $event);
		$this->dispatch(ObjectEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(ObjectEvent::POST_SKILLS_REMOVE, $event);
		$this->dispatch(ObjectEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the Sport id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setSportId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// update
		if ($model->getSportId() !== $relatedId) {
			$model->setSportId($relatedId);

			$event = new ObjectEvent($model);
			$this->dispatch(ObjectEvent::PRE_SPORT_UPDATE, $event);
			$this->dispatch(ObjectEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(ObjectEvent::POST_SPORT_UPDATE, $event);
			$this->dispatch(ObjectEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Object with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// hydrate
		$serializer = Object::getSerializer();
		$model = $serializer->hydrate($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_UPDATE, $event);
		$this->dispatch(ObjectEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(ObjectEvent::POST_UPDATE, $event);
		$this->dispatch(ObjectEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates Skills on Object
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Object not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterByObject($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->addSkill($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new ObjectEvent($model);
		$this->dispatch(ObjectEvent::PRE_SKILLS_UPDATE, $event);
		$this->dispatch(ObjectEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(ObjectEvent::POST_SKILLS_UPDATE, $event);
		$this->dispatch(ObjectEvent::POST_SAVE, $event);

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
	 * @param string $type
	 * @param ObjectEvent $event
	 */
	protected function dispatch($type, ObjectEvent $event) {
		$model = $event->getObject();
		$methods = [
			ObjectEvent::PRE_CREATE => 'preCreate',
			ObjectEvent::POST_CREATE => 'postCreate',
			ObjectEvent::PRE_UPDATE => 'preUpdate',
			ObjectEvent::POST_UPDATE => 'postUpdate',
			ObjectEvent::PRE_DELETE => 'preDelete',
			ObjectEvent::POST_DELETE => 'postDelete',
			ObjectEvent::PRE_SAVE => 'preSave',
			ObjectEvent::POST_SAVE => 'postSave'
		];

		if (isset($methods[$type])) {
			$method = $methods[$type];
			if (method_exists($this, $method)) {
				$this->$method($model);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, $event);
	}

	/**
	 * Returns one Object with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Object|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = ObjectQuery::create()->findOneById($id);
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
