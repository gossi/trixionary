<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\VideoEvent;
use gossi\trixionary\model\VideoQuery;
use gossi\trixionary\model\Video;
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
trait VideoDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Creates a new Video with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Video::getSerializer();
		$model = $serializer->hydrate(new Video(), $data);
		$this->hydrateRelationships($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new VideoEvent($model);
		$this->dispatch(VideoEvent::PRE_CREATE, $event);
		$this->dispatch(VideoEvent::PRE_SAVE, $event);
		$model->save();
		$this->dispatch(VideoEvent::POST_CREATE, $event);
		$this->dispatch(VideoEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Video with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// delete
		$event = new VideoEvent($model);
		$this->dispatch(VideoEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(VideoEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Video']);
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

		$query = VideoQuery::create();

		// sorting
		$sort = $params->getSort(Video::getSerializer()->getSortFields());
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
	 * Returns one Video with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Sets the Reference id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setReferenceId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// update
		if ($this->doSetReferenceId($model, $relatedId)) {
			$event = new VideoEvent($model);
			$this->dispatch(VideoEvent::PRE_REFERENCE_UPDATE, $event);
			$this->dispatch(VideoEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(VideoEvent::POST_REFERENCE_UPDATE, $event);
			$this->dispatch(VideoEvent::POST_SAVE, $event);

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
			return new NotFound(['message' => 'Video not found.']);
		}

		// update
		if ($this->doSetSkillId($model, $relatedId)) {
			$event = new VideoEvent($model);
			$this->dispatch(VideoEvent::PRE_SKILL_UPDATE, $event);
			$this->dispatch(VideoEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(VideoEvent::POST_SKILL_UPDATE, $event);
			$this->dispatch(VideoEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Video with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// hydrate
		$serializer = Video::getSerializer();
		$model = $serializer->hydrate($model, $data);
		$this->hydrateRelationships($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new VideoEvent($model);
		$this->dispatch(VideoEvent::PRE_UPDATE, $event);
		$this->dispatch(VideoEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_UPDATE, $event);
		$this->dispatch(VideoEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
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
	 * @param VideoEvent $event
	 */
	protected function dispatch($type, VideoEvent $event) {
		$model = $event->getVideo();
		$methods = [
			VideoEvent::PRE_CREATE => 'preCreate',
			VideoEvent::POST_CREATE => 'postCreate',
			VideoEvent::PRE_UPDATE => 'preUpdate',
			VideoEvent::POST_UPDATE => 'postUpdate',
			VideoEvent::PRE_DELETE => 'preDelete',
			VideoEvent::POST_DELETE => 'postDelete',
			VideoEvent::PRE_SAVE => 'preSave',
			VideoEvent::POST_SAVE => 'postSave'
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
	 * Internal mechanism to set the Reference id
	 * 
	 * @param Video $model
	 * @param mixed $relatedId
	 */
	protected function doSetReferenceId(Video $model, $relatedId) {
		if ($model->getReferenceId() !== $relatedId) {
			$model->setReferenceId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Skill id
	 * 
	 * @param Video $model
	 * @param mixed $relatedId
	 */
	protected function doSetSkillId(Video $model, $relatedId) {
		if ($model->getSkillId() !== $relatedId) {
			$model->setSkillId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Returns one Video with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Video|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = VideoQuery::create()->findOneById($id);
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
