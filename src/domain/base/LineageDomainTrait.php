<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\LineageEvent;
use gossi\trixionary\model\LineageQuery;
use gossi\trixionary\model\Lineage;
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
trait LineageDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Creates a new Lineage with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Lineage::getSerializer();
		$model = $serializer->hydrate(new Lineage(), $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(LineageEvent::PRE_CREATE, $model, $data);
		$this->dispatch(LineageEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispatch post save hooks
		$model->save();
		$this->dispatch(LineageEvent::POST_CREATE, $model, $data);
		$this->dispatch(LineageEvent::POST_SAVE, $model, $data);

		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Lineage with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Lineage not found.']);
		}

		// delete
		$this->dispatch(LineageEvent::PRE_DELETE, $model);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(LineageEvent::POST_DELETE, $model);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Lineage']);
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

		$query = LineageQuery::create();

		// sorting
		$sort = $params->getSort(Lineage::getSerializer()->getSortFields());
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
	 * Returns one Lineage with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Lineage not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Sets the Ancestor id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setAncestorId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Lineage not found.']);
		}

		// update
		if ($this->doSetAncestorId($model, $relatedId)) {
			$this->dispatch(LineageEvent::PRE_ANCESTOR_UPDATE, $model);
			$this->dispatch(LineageEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(LineageEvent::POST_ANCESTOR_UPDATE, $model);
			$this->dispatch(LineageEvent::POST_SAVE, $model);

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
			return new NotFound(['message' => 'Lineage not found.']);
		}

		// update
		if ($this->doSetSkillId($model, $relatedId)) {
			$this->dispatch(LineageEvent::PRE_SKILL_UPDATE, $model);
			$this->dispatch(LineageEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(LineageEvent::POST_SKILL_UPDATE, $model);
			$this->dispatch(LineageEvent::POST_SAVE, $model);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Lineage with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Lineage not found.']);
		}

		// hydrate
		$serializer = Lineage::getSerializer();
		$model = $serializer->hydrate($model, $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(LineageEvent::PRE_UPDATE, $model, $data);
		$this->dispatch(LineageEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispath post save hooks
		$rows = $model->save();
		$this->dispatch(LineageEvent::POST_UPDATE, $model, $data);
		$this->dispatch(LineageEvent::POST_SAVE, $model, $data);

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
	 * @param Lineage $model
	 * @param array $data
	 */
	protected function dispatch($type, Lineage $model, array $data = []) {
		$methods = [
			LineageEvent::PRE_CREATE => 'preCreate',
			LineageEvent::POST_CREATE => 'postCreate',
			LineageEvent::PRE_UPDATE => 'preUpdate',
			LineageEvent::POST_UPDATE => 'postUpdate',
			LineageEvent::PRE_DELETE => 'preDelete',
			LineageEvent::POST_DELETE => 'postDelete',
			LineageEvent::PRE_SAVE => 'preSave',
			LineageEvent::POST_SAVE => 'postSave'
		];

		if (isset($methods[$type])) {
			$method = $methods[$type];
			if (method_exists($this, $method)) {
				$this->$method($model, $data);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, new LineageEvent($model));
	}

	/**
	 * Internal mechanism to set the Ancestor id
	 * 
	 * @param Lineage $model
	 * @param mixed $relatedId
	 */
	protected function doSetAncestorId(Lineage $model, $relatedId) {
		if ($model->getAncestorId() !== $relatedId) {
			$model->setAncestorId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Skill id
	 * 
	 * @param Lineage $model
	 * @param mixed $relatedId
	 */
	protected function doSetSkillId(Lineage $model, $relatedId) {
		if ($model->getSkillId() !== $relatedId) {
			$model->setSkillId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Returns one Lineage with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Lineage|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = LineageQuery::create()->findOneById($id);
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
