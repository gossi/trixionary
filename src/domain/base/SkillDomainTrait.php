<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\SkillEvent;
use gossi\trixionary\model\FunctionPhaseQuery;
use gossi\trixionary\model\GroupQuery;
use gossi\trixionary\model\KstrukturQuery;
use gossi\trixionary\model\PictureQuery;
use gossi\trixionary\model\ReferenceQuery;
use gossi\trixionary\model\SkillDependencyQuery;
use gossi\trixionary\model\SkillGroupQuery;
use gossi\trixionary\model\SkillPartQuery;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\SkillQuery;
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
use keeko\framework\service\ServiceContainer;
use keeko\framework\utils\NameUtils;
use keeko\framework\utils\Parameters;
use phootwork\collection\Map;

/**
 */
trait SkillDomainTrait {

	/**
	 */
	protected $pool;

	/**
	 * Adds Children to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addChildren($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('children');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_CHILDREN_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds FunctionPhases to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addFunctionPhases($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('function-phases');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			}
			$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Groups to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('groups');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_GROUPS_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Kstrukturs to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addKstrukturs($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('kstrukturs');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			}
			$related = KstrukturQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Multiples to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addMultiples($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('multiples');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_MULTIPLES_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Parts to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addParts($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('parts');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PARTS_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Pictures to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addPictures($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('pictures');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			}
			$related = PictureQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PICTURES_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds References to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addReferences($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('references');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			}
			$related = ReferenceQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_REFERENCES_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Variations to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addVariations($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('variations');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VARIATIONS_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Videos to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('videos');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			}
			$related = VideoQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VIDEOS_ADD, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_ADD, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Creates a new Skill with the provided data
	 * 
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function create($data) {
		// hydrate
		$serializer = Skill::getSerializer();
		$model = $serializer->hydrate(new Skill(), $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_CREATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$model->save();
		$this->dispatch(SkillEvent::POST_CREATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);
		return new Created(['model' => $model]);
	}

	/**
	 * Deletes a Skill with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function delete($id) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// delete
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_DELETE, $event);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(SkillEvent::POST_DELETE, $event);
			return new Deleted(['model' => $model]);
		}

		return new NotDeleted(['message' => 'Could not delete Skill']);
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

		$query = SkillQuery::create();

		// sorting
		$sort = $params->getSort(Skill::getSerializer()->getSortFields());
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
	 * Returns one Skill with the given id
	 * 
	 * @param mixed $id
	 * @return PayloadInterface
	 */
	public function read($id) {
		// read
		$model = $this->get($id);

		// check existence
		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		return new Found(['model' => $model]);
	}

	/**
	 * Removes Children from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeChildren($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('children');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_CHILDREN_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes FunctionPhases from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeFunctionPhases($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('function-phases');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			}
			$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Groups from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('groups');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_GROUPS_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Kstrukturs from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeKstrukturs($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('kstrukturs');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			}
			$related = KstrukturQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Multiples from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeMultiples($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('multiples');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_MULTIPLES_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Parts from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeParts($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('parts');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PARTS_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Pictures from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removePictures($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('pictures');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			}
			$related = PictureQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PICTURES_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes References from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeReferences($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('references');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			}
			$related = ReferenceQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_REFERENCES_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Variations from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeVariations($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('variations');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VARIATIONS_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Videos from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove them
		$serializer = Skill::getSerializer();
		$method = 'remove' . $serializer->getCollectionMethodName('videos');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			}
			$related = VideoQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VIDEOS_REMOVE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_REMOVE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the EndPosition id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setEndPositionId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getEndPositionId() !== $relatedId) {
			$model->setEndPositionId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_END_POSITION_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_END_POSITION_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the FeaturedPicture id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setFeaturedPictureId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getPictureId() !== $relatedId) {
			$model->setPictureId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_FEATURED_PICTURE_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_FEATURED_PICTURE_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the FunctionPhaseRoot id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setFunctionPhaseRootId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getFunctionPhaseId() !== $relatedId) {
			$model->setFunctionPhaseId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_FUNCTION_PHASE_ROOT_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_FUNCTION_PHASE_ROOT_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the KstrukturRoot id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setKstrukturRootId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getKstrukturId() !== $relatedId) {
			$model->setKstrukturId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_KSTRUKTUR_ROOT_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_KSTRUKTUR_ROOT_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the MultipleOf id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setMultipleOfId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getMultipleOfId() !== $relatedId) {
			$model->setMultipleOfId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_MULTIPLE_OF_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_MULTIPLE_OF_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the Object id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setObjectId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getObjectId() !== $relatedId) {
			$model->setObjectId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_OBJECT_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_OBJECT_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

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
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getSportId() !== $relatedId) {
			$model->setSportId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_SPORT_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_SPORT_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the StartPosition id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setStartPositionId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getStartPositionId() !== $relatedId) {
			$model->setStartPositionId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_START_POSITION_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_START_POSITION_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Sets the VariationOf id
	 * 
	 * @param mixed $id
	 * @param mixed $relatedId
	 * @return PayloadInterface
	 */
	public function setVariationOfId($id, $relatedId) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// update
		if ($model->getVariationOfId() !== $relatedId) {
			$model->setVariationOfId($relatedId);

			$event = new SkillEvent($model);
			$this->dispatch(SkillEvent::PRE_VARIATION_OF_UPDATE, $event);
			$this->dispatch(SkillEvent::PRE_SAVE, $event);
			$model->save();
			$this->dispatch(SkillEvent::POST_VARIATION_OF_UPDATE, $event);
			$this->dispatch(SkillEvent::POST_SAVE, $event);

			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates a Skill with the given idand the provided data
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function update($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// hydrate
		$serializer = Skill::getSerializer();
		$model = $serializer->hydrate($model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// dispatch
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		$payload = ['model' => $model];

		if ($rows === 0) {
			return new NotUpdated($payload);
		}

		return new Updated($payload);
	}

	/**
	 * Updates Children on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateChildren($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		SkillDependencyQuery::create()->filterByParent($model)->delete();

		// add them
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('children');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_CHILDREN_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates FunctionPhases on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateFunctionPhases($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		FunctionPhaseQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			}
			$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
			$model->addFunctionPhase($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Groups on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateGroups($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		SkillGroupQuery::create()->filterBySkill($model)->delete();

		// add them
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('groups');
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			}
			$related = GroupQuery::create()->findOneById($entry['id']);
			$model->$method($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_GROUPS_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Kstrukturs on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateKstrukturs($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		KstrukturQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			}
			$related = KstrukturQuery::create()->findOneById($entry['id']);
			$model->addKstruktur($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Multiples on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateMultiples($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterByMultipleOf($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->addMultiple($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_MULTIPLES_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Parts on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateParts($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		SkillPartQuery::create()->filterByComposite($model)->delete();

		// add them
		$serializer = Skill::getSerializer();
		$method = 'add' . $serializer->getCollectionMethodName('parts');
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
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PARTS_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Pictures on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updatePictures($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		PictureQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			}
			$related = PictureQuery::create()->findOneById($entry['id']);
			$model->addPicture($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_PICTURES_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates References on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateReferences($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		ReferenceQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			}
			$related = ReferenceQuery::create()->findOneById($entry['id']);
			$model->addReference($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_REFERENCES_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Variations on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateVariations($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		SkillQuery::create()->filterByVariationOf($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			}
			$related = SkillQuery::create()->findOneById($entry['id']);
			$model->addVariation($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VARIATIONS_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Videos on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateVideos($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// remove all relationships before
		VideoQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Video';
			}
			$related = VideoQuery::create()->findOneById($entry['id']);
			$model->addVideo($related);
		}

		if (count($errors) > 0) {
			return new NotValid(['errors' => $errors]);
		}

		// save and dispatch events
		$event = new SkillEvent($model);
		$this->dispatch(SkillEvent::PRE_VIDEOS_UPDATE, $event);
		$this->dispatch(SkillEvent::PRE_SAVE, $event);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_UPDATE, $event);
		$this->dispatch(SkillEvent::POST_SAVE, $event);

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
	 * @param SkillEvent $event
	 */
	protected function dispatch($type, SkillEvent $event) {
		$model = $event->getSkill();
		$methods = [
			SkillEvent::PRE_CREATE => 'preCreate',
			SkillEvent::POST_CREATE => 'postCreate',
			SkillEvent::PRE_UPDATE => 'preUpdate',
			SkillEvent::POST_UPDATE => 'postUpdate',
			SkillEvent::PRE_DELETE => 'preDelete',
			SkillEvent::POST_DELETE => 'postDelete',
			SkillEvent::PRE_SAVE => 'preSave',
			SkillEvent::POST_SAVE => 'postSave'
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
	 * Returns one Skill with the given id from cache
	 * 
	 * @param mixed $id
	 * @return Skill|null
	 */
	protected function get($id) {
		if ($this->pool === null) {
			$this->pool = new Map();
		} else if ($this->pool->has($id)) {
			return $this->pool->get($id);
		}

		$model = SkillQuery::create()->findOneById($id);
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
