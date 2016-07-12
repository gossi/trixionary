<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\VideoEvent;
use gossi\trixionary\model\SkillQuery;
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
use keeko\framework\exceptions\ErrorsException;
use keeko\framework\service\ServiceContainer;
use keeko\framework\utils\NameUtils;
use keeko\framework\utils\Parameters;
use phootwork\collection\Map;
use phootwork\lang\Text;

/**
 */
trait VideoDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds FeaturedSkills to Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addFeaturedSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddFeaturedSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_SKILLS_ADD, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_SKILLS_ADD, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds FeaturedTutorialSkills to Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addFeaturedTutorialSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddFeaturedTutorialSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_TUTORIAL_SKILLS_ADD, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_TUTORIAL_SKILLS_ADD, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

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

		// dispatch pre save hooks
		$this->dispatch(VideoEvent::PRE_CREATE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispatch post save hooks
		$model->save();
		$this->dispatch(VideoEvent::POST_CREATE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

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
		$this->dispatch(VideoEvent::PRE_DELETE, $model);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(VideoEvent::POST_DELETE, $model);
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
		if ($size == -1) {
			$model = $query->findAll();
		} else {
			$model = $query->paginate($page, $size);
		}

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
	 * Removes FeaturedSkills from Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeFeaturedSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveFeaturedSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_SKILLS_REMOVE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_SKILLS_REMOVE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes FeaturedTutorialSkills from Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeFeaturedTutorialSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveFeaturedTutorialSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_TUTORIAL_SKILLS_REMOVE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_TUTORIAL_SKILLS_REMOVE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
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
			$this->dispatch(VideoEvent::PRE_REFERENCE_UPDATE, $model);
			$this->dispatch(VideoEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(VideoEvent::POST_REFERENCE_UPDATE, $model);
			$this->dispatch(VideoEvent::POST_SAVE, $model);

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
			$this->dispatch(VideoEvent::PRE_SKILL_UPDATE, $model);
			$this->dispatch(VideoEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(VideoEvent::POST_SKILL_UPDATE, $model);
			$this->dispatch(VideoEvent::POST_SAVE, $model);

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

		// dispatch pre save hooks
		$this->dispatch(VideoEvent::PRE_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispath post save hooks
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates FeaturedSkills on Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateFeaturedSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateFeaturedSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_SKILLS_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_SKILLS_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates FeaturedTutorialSkills on Video
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateFeaturedTutorialSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Video not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateFeaturedTutorialSkills($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(VideoEvent::PRE_FEATURED_TUTORIAL_SKILLS_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(VideoEvent::POST_FEATURED_TUTORIAL_SKILLS_UPDATE, $model, $data);
		$this->dispatch(VideoEvent::POST_SAVE, $model, $data);

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
	 * @param Video $model
	 * @param array $data
	 */
	protected function dispatch($type, Video $model, array $data = []) {
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
				$this->$method($model, $data);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, new VideoEvent($model));
	}

	/**
	 * Interal mechanism to add FeaturedSkills to Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doAddFeaturedSkills(Video $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addFeaturedSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add FeaturedTutorialSkills to Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doAddFeaturedTutorialSkills(Video $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addFeaturedTutorialSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove FeaturedSkills from Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doRemoveFeaturedSkills(Video $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeFeaturedSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove FeaturedTutorialSkills from Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doRemoveFeaturedTutorialSkills(Video $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeFeaturedTutorialSkill($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
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
	 * Internal update mechanism of FeaturedSkills on Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doUpdateFeaturedSkills(Video $model, $data) {
		// remove all relationships before
		SkillQuery::create()->filterByFeaturedVideo($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addFeaturedSkill($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of FeaturedTutorialSkills on Video
	 * 
	 * @param Video $model
	 * @param mixed $data
	 */
	protected function doUpdateFeaturedTutorialSkills(Video $model, $data) {
		// remove all relationships before
		SkillQuery::create()->filterByFeaturedTutorial($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addFeaturedTutorialSkill($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
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
