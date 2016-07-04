<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\ReferenceEvent;
use gossi\trixionary\model\ReferenceQuery;
use gossi\trixionary\model\Reference;
use gossi\trixionary\model\SkillQuery;
use gossi\trixionary\model\SkillReferenceQuery;
use gossi\trixionary\model\VideoQuery;
use keeko\framework\domain\payload\Created;
use keeko\framework\domain\payload\Deleted;
use keeko\framework\domain\payload\Found;
use keeko\framework\domain\payload\NotDeleted;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\domain\payload\NotUpdated;
use keeko\framework\domain\payload\NotValid;
use keeko\framework\domain\payload\PayloadInterface;
use keeko\framework\domain\payload\Updated;
use keeko\framework\exceptions\ErrorsException;
use keeko\framework\service\ServiceContainer;
use keeko\framework\utils\NameUtils;
use keeko\framework\utils\Parameters;
use phootwork\collection\Map;

/**
 */
trait ReferenceDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds Skills to Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_SKILLS_ADD, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_SKILLS_ADD, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Videos to Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_VIDEOS_ADD, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_VIDEOS_ADD, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new Reference with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Reference::getSerializer();
		$model = $serializer->hydrate(new Reference(), $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(ReferenceEvent::PRE_CREATE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispatch post save hooks
		$model->save();
		$this->dispatch(ReferenceEvent::POST_CREATE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Reference with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// delete
		$this->dispatch(ReferenceEvent::PRE_DELETE, $model);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(ReferenceEvent::POST_DELETE, $model);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Reference']);
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

		$query = ReferenceQuery::create();

		// sorting
		$sort = $params->getSort(Reference::getSerializer()->getSortFields());
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
	 * Returns one Reference with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes Skills from Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_SKILLS_REMOVE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_SKILLS_REMOVE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Videos from Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_VIDEOS_REMOVE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_VIDEOS_REMOVE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Reference with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// hydrate
		$serializer = Reference::getSerializer();
		$model = $serializer->hydrate($model, $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(ReferenceEvent::PRE_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispath post save hooks
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates Skills on Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_SKILLS_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_SKILLS_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Videos on Reference
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Reference not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(ReferenceEvent::PRE_VIDEOS_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(ReferenceEvent::POST_VIDEOS_UPDATE, $model, $data);
		$this->dispatch(ReferenceEvent::POST_SAVE, $model, $data);

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
	 * @param Reference $model
	 * @param array $data
	 */
	protected function dispatch($type, Reference $model, array $data = []) {
		$methods = [
			ReferenceEvent::PRE_CREATE => 'preCreate',
			ReferenceEvent::POST_CREATE => 'postCreate',
			ReferenceEvent::PRE_UPDATE => 'preUpdate',
			ReferenceEvent::POST_UPDATE => 'postUpdate',
			ReferenceEvent::PRE_DELETE => 'preDelete',
			ReferenceEvent::POST_DELETE => 'postDelete',
			ReferenceEvent::PRE_SAVE => 'preSave',
			ReferenceEvent::POST_SAVE => 'postSave'
		];

		if (isset($methods[$type])) {
			$method = $methods[$type];
			if (method_exists($this, $method)) {
				$this->$method($model, $data);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, new ReferenceEvent($model));
	}

	/**
	 * Interal mechanism to add Skills to Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doAddSkills(Reference $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Videos to Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doAddVideos(Reference $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			} else {
				$related = VideoQuery::create()->findOneById($entry['id']);
				$model->addVideo($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Skills from Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doRemoveSkills(Reference $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Videos from Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doRemoveVideos(Reference $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			} else {
				$related = VideoQuery::create()->findOneById($entry['id']);
				$model->removeVideo($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Skills on Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doUpdateSkills(Reference $model, $data) {
		// remove all relationships before
		SkillReferenceQuery::create()->filterByReference($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkill($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Videos on Reference
	 * 
	 * @param Reference $model
	 * @param mixed $data
	 */
	protected function doUpdateVideos(Reference $model, $data) {
		// remove all relationships before
		VideoQuery::create()->filterByReference($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			} else {
				$related = VideoQuery::create()->findOneById($entry['id']);
				$model->addVideo($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Returns one Reference with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Reference|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = ReferenceQuery::create()->findOneById($id);
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
