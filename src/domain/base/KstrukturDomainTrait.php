<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\KstrukturEvent;
use gossi\trixionary\model\KstrukturQuery;
use gossi\trixionary\model\Kstruktur;
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
trait KstrukturDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds RootSkills to Kstruktur
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// update
		$serializer = Kstruktur::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('root-skills');
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
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_ROOT_SKILLS_ADD, $event);
		$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(KstrukturEvent::POST_ROOT_SKILLS_ADD, $event);
		$this->dispatch(KstrukturEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new Kstruktur with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Kstruktur::getSerializer();
		$model = $serializer->hydrate(new Kstruktur(), $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_CREATE, $event);
		$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
		$model->save();
		$this->dispatch(KstrukturEvent::POST_CREATE, $event);
		$this->dispatch(KstrukturEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Kstruktur with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// delete
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(KstrukturEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Kstruktur']);
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

		$query = KstrukturQuery::create();

		// sorting
		$sort = $params->getSort(Kstruktur::getSerializer()->getSortFields());
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
	 * Returns one Kstruktur with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes RootSkills from Kstruktur
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// remove them
		$serializer = Kstruktur::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('root-skills');
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
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_ROOT_SKILLS_REMOVE, $event);
		$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(KstrukturEvent::POST_ROOT_SKILLS_REMOVE, $event);
		$this->dispatch(KstrukturEvent::POST_SAVE, $event);

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
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// update
		if ($model->getSkillId() !== $relatedId) {
			$model->setSkillId($relatedId);

			$event = new KstrukturEvent($model);
			$this->dispatch(KstrukturEvent::PRE_SKILL_UPDATE, $event);
			$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(KstrukturEvent::POST_SKILL_UPDATE, $event);
			$this->dispatch(KstrukturEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Kstruktur with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// hydrate
		$serializer = Kstruktur::getSerializer();
		$model = $serializer->hydrate($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_UPDATE, $event);
		$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(KstrukturEvent::POST_UPDATE, $event);
		$this->dispatch(KstrukturEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates RootSkills on Kstruktur
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateRootSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Kstruktur not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterByKstrukturRoot($model)->delete();

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
		$event = new KstrukturEvent($model);
		$this->dispatch(KstrukturEvent::PRE_ROOT_SKILLS_UPDATE, $event);
		$this->dispatch(KstrukturEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(KstrukturEvent::POST_ROOT_SKILLS_UPDATE, $event);
		$this->dispatch(KstrukturEvent::POST_SAVE, $event);

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
	 * @param KstrukturEvent $event
	 */
	protected function dispatch($type, KstrukturEvent $event) {
		$model = $event->getKstruktur();
		$methods = [
			KstrukturEvent::PRE_CREATE => 'preCreate',
			KstrukturEvent::POST_CREATE => 'postCreate',
			KstrukturEvent::PRE_UPDATE => 'preUpdate',
			KstrukturEvent::POST_UPDATE => 'postUpdate',
			KstrukturEvent::PRE_DELETE => 'preDelete',
			KstrukturEvent::POST_DELETE => 'postDelete',
			KstrukturEvent::PRE_SAVE => 'preSave',
			KstrukturEvent::POST_SAVE => 'postSave'
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
	 * Returns one Kstruktur with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Kstruktur|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = KstrukturQuery::create()->findOneById($id);
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
