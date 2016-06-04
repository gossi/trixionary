<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\SportEvent;
use gossi\trixionary\model\GroupQuery;
use gossi\trixionary\model\ObjectQuery;
use gossi\trixionary\model\PositionQuery;
use gossi\trixionary\model\SkillQuery;
use gossi\trixionary\model\SportQuery;
use gossi\trixionary\model\Sport;
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
trait SportDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds Groups to Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}
		 
		// update
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->addGroup($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_GROUPS_ADD, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_GROUPS_ADD, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Objects to Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addObjects($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}
		 
		// update
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Object';
			}
			$related = ObjectQuery::create()->findOneById($entry['id']);
			$model->addObject($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_OBJECTS_ADD, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_OBJECTS_ADD, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Positions to Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addPositions($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}
		 
		// update
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Position';
			}
			$related = PositionQuery::create()->findOneById($entry['id']);
			$model->addPosition($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_POSITIONS_ADD, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_POSITIONS_ADD, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Skills to Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}
		 
		// update
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
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_SKILLS_ADD, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_SKILLS_ADD, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new Sport with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Sport::getSerializer();
		$model = $serializer->hydrate(new Sport(), $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_CREATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$model->save();
		$dispatcher->dispatch(SportEvent::POST_CREATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Sport with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// delete
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$dispatcher->dispatch(SportEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Sport']);
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

		$query = SportQuery::create();

		// sorting
		$sort = $params->getSort(Sport::getSerializer()->getSortFields());
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
	 * Returns one Sport with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes Groups from Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->removeGroup($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_GROUPS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_GROUPS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Objects from Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeObjects($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Object';
			}
			$related = ObjectQuery::create()->findOneById($entry['id']);
			$model->removeObject($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_OBJECTS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_OBJECTS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Positions from Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removePositions($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Position';
			}
			$related = PositionQuery::create()->findOneById($entry['id']);
			$model->removePosition($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_POSITIONS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_POSITIONS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Skills from Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->removeSkill($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_SKILLS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_SKILLS_REMOVE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Sport with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// hydrate
		$serializer = Sport::getSerializer();
		$model = $serializer->hydrate($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates Groups on Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove all relationships before
		GroupQuery::create()->filterBySport($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->addGroup($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_GROUPS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_GROUPS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Objects on Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateObjects($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove all relationships before
		ObjectQuery::create()->filterBySport($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Object';
			}
			$related = ObjectQuery::create()->findOneById($entry['id']);
			$model->addObject($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_OBJECTS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_OBJECTS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Positions on Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updatePositions($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove all relationships before
		PositionQuery::create()->filterBySport($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Position';
			}
			$related = PositionQuery::create()->findOneById($entry['id']);
			$model->addPosition($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_POSITIONS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_POSITIONS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Skills on Sport
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateSkills($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Sport not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterBySport($model)->delete();

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
		$event = new SportEvent($model);
		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch(SportEvent::PRE_SKILLS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$dispatcher->dispatch(SportEvent::POST_SKILLS_UPDATE, $event);
		$dispatcher->dispatch(SportEvent::POST_SAVE, $event);

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
	 * Returns one Sport with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Sport|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = SportQuery::create()->findOneById($id);
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
