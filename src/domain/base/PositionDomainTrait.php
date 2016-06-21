<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\PositionEvent;
use gossi\trixionary\model\PositionQuery;
use gossi\trixionary\model\Position;
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
trait PositionDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Creates a new Position with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Position::getSerializer();
		$model = $serializer->hydrate(new Position(), $data);
		$this->hydrateRelationships($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new PositionEvent($model);
		$this->dispatch(PositionEvent::PRE_CREATE, $event);
		$this->dispatch(PositionEvent::PRE_SAVE, $event);
		$model->save();
		$this->dispatch(PositionEvent::POST_CREATE, $event);
		$this->dispatch(PositionEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Position with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Position not found.']);
		}

		// delete
		$event = new PositionEvent($model);
		$this->dispatch(PositionEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(PositionEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Position']);
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

		$query = PositionQuery::create();

		// sorting
		$sort = $params->getSort(Position::getSerializer()->getSortFields());
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
	 * Returns one Position with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Position not found.']);
		}

		return new Found(['model' => $model]);
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
			return new NotFound(['message' => 'Position not found.']);
		}

		// update
		if ($this->doSetSkillId($model, $relatedId)) {
			$event = new PositionEvent($model);
			$this->dispatch(PositionEvent::PRE_SKILL_UPDATE, $event);
			$this->dispatch(PositionEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(PositionEvent::POST_SKILL_UPDATE, $event);
			$this->dispatch(PositionEvent::POST_SAVE, $event);

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
			return new NotFound(['message' => 'Position not found.']);
		}

		// update
		if ($this->doSetSportId($model, $relatedId)) {
			$event = new PositionEvent($model);
			$this->dispatch(PositionEvent::PRE_SPORT_UPDATE, $event);
			$this->dispatch(PositionEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(PositionEvent::POST_SPORT_UPDATE, $event);
			$this->dispatch(PositionEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Position with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Position not found.']);
		}

		// hydrate
		$serializer = Position::getSerializer();
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
		$event = new PositionEvent($model);
		$this->dispatch(PositionEvent::PRE_UPDATE, $event);
		$this->dispatch(PositionEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(PositionEvent::POST_UPDATE, $event);
		$this->dispatch(PositionEvent::POST_SAVE, $event);

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
	 * @param PositionEvent $event
	 */
	protected function dispatch($type, PositionEvent $event) {
		$model = $event->getPosition();
		$methods = [
			PositionEvent::PRE_CREATE => 'preCreate',
			PositionEvent::POST_CREATE => 'postCreate',
			PositionEvent::PRE_UPDATE => 'preUpdate',
			PositionEvent::POST_UPDATE => 'postUpdate',
			PositionEvent::PRE_DELETE => 'preDelete',
			PositionEvent::POST_DELETE => 'postDelete',
			PositionEvent::PRE_SAVE => 'preSave',
			PositionEvent::POST_SAVE => 'postSave'
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
	 * Internal mechanism to set the Skill id
	 * 
	 * @param Position $model
	 * @param mixed $relatedId
	 */
	protected function doSetSkillId(Position $model, $relatedId) {
		if ($model->getEndPositionId() !== $relatedId) {
			$model->setEndPositionId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Sport id
	 * 
	 * @param Position $model
	 * @param mixed $relatedId
	 */
	protected function doSetSportId(Position $model, $relatedId) {
		if ($model->getSportId() !== $relatedId) {
			$model->setSportId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Returns one Position with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Position|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = PositionQuery::create()->findOneById($id);
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
