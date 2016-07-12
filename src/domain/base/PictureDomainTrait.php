<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\PictureEvent;
use gossi\trixionary\model\Picture;
use gossi\trixionary\model\PictureQuery;
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
use phootwork\lang\Text;

/**
 */
trait PictureDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Creates a new Picture with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Picture::getSerializer();
		$model = $serializer->hydrate(new Picture(), $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(PictureEvent::PRE_CREATE, $model, $data);
		$this->dispatch(PictureEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispatch post save hooks
		$model->save();
		$this->dispatch(PictureEvent::POST_CREATE, $model, $data);
		$this->dispatch(PictureEvent::POST_SAVE, $model, $data);

		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Picture with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Picture not found.']);
		}

		// delete
		$this->dispatch(PictureEvent::PRE_DELETE, $model);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(PictureEvent::POST_DELETE, $model);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Picture']);
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

		$query = PictureQuery::create();

		// sorting
		$sort = $params->getSort(Picture::getSerializer()->getSortFields());
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
		if ($size == -1) {
			$model = $query->findAll();
		} else {
			$model = $query->paginate($page, $size);
		}

		// run response
		return new Found(['model' => $model]);
	}

	/**
	 * Returns one Picture with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Picture not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Sets the FeaturedSkill id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setFeaturedSkillId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Picture not found.']);
		}

		// update
		if ($this->doSetFeaturedSkillId($model, $relatedId)) {
			$this->dispatch(PictureEvent::PRE_FEATURED_SKILL_UPDATE, $model);
			$this->dispatch(PictureEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(PictureEvent::POST_FEATURED_SKILL_UPDATE, $model);
			$this->dispatch(PictureEvent::POST_SAVE, $model);

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
			return new NotFound(['message' => 'Picture not found.']);
		}

		// update
		if ($this->doSetSkillId($model, $relatedId)) {
			$this->dispatch(PictureEvent::PRE_SKILL_UPDATE, $model);
			$this->dispatch(PictureEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(PictureEvent::POST_SKILL_UPDATE, $model);
			$this->dispatch(PictureEvent::POST_SAVE, $model);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Picture with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Picture not found.']);
		}

		// hydrate
		$serializer = Picture::getSerializer();
		$model = $serializer->hydrate($model, $data);
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(PictureEvent::PRE_UPDATE, $model, $data);
		$this->dispatch(PictureEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispath post save hooks
		$rows = $model->save();
		$this->dispatch(PictureEvent::POST_UPDATE, $model, $data);
		$this->dispatch(PictureEvent::POST_SAVE, $model, $data);

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
		if (is_array($filter)) {

			// filter by fields
			if (isset($filter['fields'])) {
		    	foreach ($filter['fields'] as $column => $value) {
		        	$pos = strpos($column, '.');
		        	if ($pos !== false) {
		        		$rel = NameUtils::toStudlyCase(substr($column, 0, $pos));
		        		$col = substr($column, $pos + 1);
		        		$method = 'use' . $rel . 'Query';
		        		if (method_exists($query, $method)) {
		        			$sub = $query->$method();
		        			$this->applyFilter($sub, ['fields' => [$col => $value]]);
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
		    
		    // filter by features
		    if (isset($filter['features'])) {
		    	$features = new Text($filter['features']);
		    	if ($features->contains('random')) {
		    		$query->addAscendingOrderByColumn('RAND()');
		    	}
		    }
		}

		if (method_exists($this, 'filter')) {
			$this->filter($query, $filter);
		}
	}

	/**
	 * @param string $type
	 * @param Picture $model
	 * @param array $data
	 */
	protected function dispatch($type, Picture $model, array $data = []) {
		$methods = [
			PictureEvent::PRE_CREATE => 'preCreate',
			PictureEvent::POST_CREATE => 'postCreate',
			PictureEvent::PRE_UPDATE => 'preUpdate',
			PictureEvent::POST_UPDATE => 'postUpdate',
			PictureEvent::PRE_DELETE => 'preDelete',
			PictureEvent::POST_DELETE => 'postDelete',
			PictureEvent::PRE_SAVE => 'preSave',
			PictureEvent::POST_SAVE => 'postSave'
		];

		if (isset($methods[$type])) {
			$method = $methods[$type];
			if (method_exists($this, $method)) {
				$this->$method($model, $data);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, new PictureEvent($model));
	}

	/**
	 * Internal mechanism to set the FeaturedSkill id
	 * 
	 * @param Picture $model
	 * @param mixed $relatedId
	 */
	protected function doSetFeaturedSkillId(Picture $model, $relatedId) {
		if ($model->getPictureId() !== $relatedId) {
			$model->setPictureId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Skill id
	 * 
	 * @param Picture $model
	 * @param mixed $relatedId
	 */
	protected function doSetSkillId(Picture $model, $relatedId) {
		if ($model->getSkillId() !== $relatedId) {
			$model->setSkillId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Returns one Picture with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Picture|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = PictureQuery::create()->findOneById($id);
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
