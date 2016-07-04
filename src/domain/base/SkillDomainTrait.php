<?php
namespace gossi\trixionary\domain\base;

use gossi\trixionary\event\SkillEvent;
use gossi\trixionary\model\FunctionPhaseQuery;
use gossi\trixionary\model\GroupQuery;
use gossi\trixionary\model\KstrukturQuery;
use gossi\trixionary\model\LineageQuery;
use gossi\trixionary\model\PictureQuery;
use gossi\trixionary\model\ReferenceQuery;
use gossi\trixionary\model\SkillDependencyQuery;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\SkillGroupQuery;
use gossi\trixionary\model\SkillPartQuery;
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

		// pass add to internal logic
		try {
			$this->doAddChildren($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Composites to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addComposites($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddComposites($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddFunctionPhases($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddGroups($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_GROUPS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddKstrukturs($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Lineages to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addLineages($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddLineages($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_LINEAGES_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_LINEAGES_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddMultiples($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_MULTIPLES_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Adds Parents to Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function addParents($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass add to internal logic
		try {
			$this->doAddParents($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddParts($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddPictures($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PICTURES_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddReferences($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_REFERENCES_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddVariations($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VARIATIONS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass add to internal logic
		try {
			$this->doAddVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VIDEOS_ADD, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_ADD, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(SkillEvent::PRE_CREATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispatch post save hooks
		$model->save();
		$this->dispatch(SkillEvent::POST_CREATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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
		$this->dispatch(SkillEvent::PRE_DELETE, $model);
		$model->delete();

		if ($model->isDeleted()) {
			$this->dispatch(SkillEvent::POST_DELETE, $model);
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

		// pass remove to internal logic
		try {
			$this->doRemoveChildren($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Composites from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeComposites($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveComposites($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveFunctionPhases($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveGroups($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_GROUPS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveKstrukturs($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Lineages from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeLineages($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveLineages($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_LINEAGES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_LINEAGES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveMultiples($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_MULTIPLES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Removes Parents from Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function removeParents($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass remove to internal logic
		try {
			$this->doRemoveParents($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveParts($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemovePictures($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PICTURES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveReferences($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_REFERENCES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveVariations($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VARIATIONS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass remove to internal logic
		try {
			$this->doRemoveVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VIDEOS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_REMOVE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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
		if ($this->doSetEndPositionId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_END_POSITION_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_END_POSITION_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetFeaturedPictureId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_FEATURED_PICTURE_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_FEATURED_PICTURE_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetFunctionPhaseRootId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_FUNCTION_PHASE_ROOT_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_FUNCTION_PHASE_ROOT_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetKstrukturRootId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_KSTRUKTUR_ROOT_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_KSTRUKTUR_ROOT_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetMultipleOfId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_MULTIPLE_OF_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_MULTIPLE_OF_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetObjectId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_OBJECT_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_OBJECT_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetSportId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_SPORT_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_SPORT_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetStartPositionId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_START_POSITION_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_START_POSITION_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		if ($this->doSetVariationOfId($model, $relatedId)) {
			$this->dispatch(SkillEvent::PRE_VARIATION_OF_UPDATE, $model);
			$this->dispatch(SkillEvent::PRE_SAVE, $model);
			$model->save();
			$this->dispatch(SkillEvent::POST_VARIATION_OF_UPDATE, $model);
			$this->dispatch(SkillEvent::POST_SAVE, $model);

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
		$this->hydrateRelationships($model, $data);

		// dispatch pre save hooks
		$this->dispatch(SkillEvent::PRE_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);

		// validate
		$validator = $this->getValidator();
		if ($validator !== null && !$validator->validate($model)) {
			return new NotValid([
				'errors' => $validator->getValidationFailures()
			]);
		}

		// save and dispath post save hooks
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateChildren($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Composites on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateComposites($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateComposite($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateFunctionPhases($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_FUNCTION_PHASES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_FUNCTION_PHASES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateGroups($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_GROUPS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_GROUPS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateKstrukturs($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_KSTRUKTURS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_KSTRUKTURS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Lineages on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateLineages($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateLineages($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_LINEAGES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_LINEAGES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateMultiples($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_MULTIPLES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_MULTIPLES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

		if ($rows > 0) {
			return Updated(['model' => $model]);
		}

		return NotUpdated(['model' => $model]);
	}

	/**
	 * Updates Parents on Skill
	 * 
	 * @param mixed $id
	 * @param mixed $data
	 * @return PayloadInterface
	 */
	public function updateParents($id, $data) {
		// find
		$model = $this->get($id);

		if ($model === null) {
			return new NotFound(['message' => 'Skill not found.']);
		}

		// pass update to internal logic
		try {
			$this->doUpdateParent($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_CHILDREN_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_CHILDREN_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateParts($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PARTS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PARTS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdatePictures($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_PICTURES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_PICTURES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateReferences($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_REFERENCES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_REFERENCES_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateVariations($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VARIATIONS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VARIATIONS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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

		// pass update to internal logic
		try {
			$this->doUpdateVideos($model, $data);
		} catch (ErrorsException $e) {
			return new NotValid(['errors' => $e->getErrors()]);
		}

		// save and dispatch events
		$this->dispatch(SkillEvent::PRE_VIDEOS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::PRE_SAVE, $model, $data);
		$rows = $model->save();
		$this->dispatch(SkillEvent::POST_VIDEOS_UPDATE, $model, $data);
		$this->dispatch(SkillEvent::POST_SAVE, $model, $data);

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
	 * @param Skill $model
	 * @param array $data
	 */
	protected function dispatch($type, Skill $model, array $data = []) {
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
				$this->$method($model, $data);
			}
		}

		$dispatcher = $this->getServiceContainer()->getDispatcher();
		$dispatcher->dispatch($type, new SkillEvent($model));
	}

	/**
	 * Interal mechanism to add Children to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddChildren(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByDependencyId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Composites to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddComposites(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByCompositeId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add FunctionPhases to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddFunctionPhases(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			} else {
				$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
				$model->addFunctionPhase($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Groups to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddGroups(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			} else {
				$related = GroupQuery::create()->findOneById($entry['id']);
				$model->addGroup($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Kstrukturs to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddKstrukturs(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			} else {
				$related = KstrukturQuery::create()->findOneById($entry['id']);
				$model->addKstruktur($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Lineages to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddLineages(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Lineage';
			} else {
				$related = LineageQuery::create()->findOneById($entry['id']);
				$model->addLineage($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Multiples to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddMultiples(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addMultiple($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Parents to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddParents(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByParentId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Parts to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddParts(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByPartId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Pictures to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddPictures(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			} else {
				$related = PictureQuery::create()->findOneById($entry['id']);
				$model->addPicture($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add References to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddReferences(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			} else {
				$related = ReferenceQuery::create()->findOneById($entry['id']);
				$model->addReference($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Variations to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddVariations(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addVariation($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to add Videos to Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doAddVideos(Skill $model, $data) {
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
	 * Interal mechanism to remove Children from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveChildren(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeSkillRelatedByDependencyId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Composites from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveComposites(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeSkillRelatedByPartId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove FunctionPhases from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveFunctionPhases(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			} else {
				$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
				$model->removeFunctionPhase($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Groups from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveGroups(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			} else {
				$related = GroupQuery::create()->findOneById($entry['id']);
				$model->removeGroup($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Kstrukturs from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveKstrukturs(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			} else {
				$related = KstrukturQuery::create()->findOneById($entry['id']);
				$model->removeKstruktur($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Lineages from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveLineages(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Lineage';
			} else {
				$related = LineageQuery::create()->findOneById($entry['id']);
				$model->removeLineage($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Multiples from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveMultiples(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeMultiple($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Parents from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveParents(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeSkillRelatedByDependencyId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Parts from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveParts(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeSkillRelatedByPartId($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Pictures from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemovePictures(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			} else {
				$related = PictureQuery::create()->findOneById($entry['id']);
				$model->removePicture($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove References from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveReferences(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			} else {
				$related = ReferenceQuery::create()->findOneById($entry['id']);
				$model->removeReference($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Variations from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveVariations(Skill $model, $data) {
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->removeVariation($related);
			}
		}

		if (count($errors) > 0) {
			return new ErrorsException($errors);
		}
	}

	/**
	 * Interal mechanism to remove Videos from Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doRemoveVideos(Skill $model, $data) {
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
	 * Internal mechanism to set the EndPosition id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetEndPositionId(Skill $model, $relatedId) {
		if ($model->getEndPositionId() !== $relatedId) {
			$model->setEndPositionId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the FeaturedPicture id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetFeaturedPictureId(Skill $model, $relatedId) {
		if ($model->getPictureId() !== $relatedId) {
			$model->setPictureId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the FunctionPhaseRoot id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetFunctionPhaseRootId(Skill $model, $relatedId) {
		if ($model->getFunctionPhaseId() !== $relatedId) {
			$model->setFunctionPhaseId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the KstrukturRoot id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetKstrukturRootId(Skill $model, $relatedId) {
		if ($model->getKstrukturId() !== $relatedId) {
			$model->setKstrukturId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the MultipleOf id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetMultipleOfId(Skill $model, $relatedId) {
		if ($model->getMultipleOfId() !== $relatedId) {
			$model->setMultipleOfId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Object id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetObjectId(Skill $model, $relatedId) {
		if ($model->getObjectId() !== $relatedId) {
			$model->setObjectId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the Sport id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetSportId(Skill $model, $relatedId) {
		if ($model->getSportId() !== $relatedId) {
			$model->setSportId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the StartPosition id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetStartPositionId(Skill $model, $relatedId) {
		if ($model->getStartPositionId() !== $relatedId) {
			$model->setStartPositionId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal mechanism to set the VariationOf id
	 * 
	 * @param Skill $model
	 * @param mixed $relatedId
	 */
	protected function doSetVariationOfId(Skill $model, $relatedId) {
		if ($model->getVariationOfId() !== $relatedId) {
			$model->setVariationOfId($relatedId);

			return true;
		}

		return false;
	}

	/**
	 * Internal update mechanism of Children on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateChildren(Skill $model, $data) {
		// remove all relationships before
		SkillDependencyQuery::create()->filterBySkillRelatedByParentId($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByDependencyId($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Composites on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateComposites(Skill $model, $data) {
		// remove all relationships before
		SkillPartQuery::create()->filterBySkillRelatedByPartId($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByCompositeId($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of FunctionPhases on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateFunctionPhases(Skill $model, $data) {
		// remove all relationships before
		FunctionPhaseQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for FunctionPhase';
			} else {
				$related = FunctionPhaseQuery::create()->findOneById($entry['id']);
				$model->addFunctionPhase($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Groups on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateGroups(Skill $model, $data) {
		// remove all relationships before
		SkillGroupQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Group';
			} else {
				$related = GroupQuery::create()->findOneById($entry['id']);
				$model->addGroup($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Kstrukturs on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateKstrukturs(Skill $model, $data) {
		// remove all relationships before
		KstrukturQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Kstruktur';
			} else {
				$related = KstrukturQuery::create()->findOneById($entry['id']);
				$model->addKstruktur($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Lineages on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateLineages(Skill $model, $data) {
		// remove all relationships before
		LineageQuery::create()->filterByAncestor($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Lineage';
			} else {
				$related = LineageQuery::create()->findOneById($entry['id']);
				$model->addLineage($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Multiples on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateMultiples(Skill $model, $data) {
		// remove all relationships before
		SkillQuery::create()->filterByMultipleOf($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addMultiple($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Parents on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateParents(Skill $model, $data) {
		// remove all relationships before
		SkillDependencyQuery::create()->filterBySkillRelatedByDependencyId($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByParentId($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Parts on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateParts(Skill $model, $data) {
		// remove all relationships before
		SkillPartQuery::create()->filterBySkillRelatedByCompositeId($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addSkillRelatedByPartId($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Pictures on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdatePictures(Skill $model, $data) {
		// remove all relationships before
		PictureQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Picture';
			} else {
				$related = PictureQuery::create()->findOneById($entry['id']);
				$model->addPicture($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of References on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateReferences(Skill $model, $data) {
		// remove all relationships before
		SkillReferenceQuery::create()->filterBySkill($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Reference';
			} else {
				$related = ReferenceQuery::create()->findOneById($entry['id']);
				$model->addReference($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Variations on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateVariations(Skill $model, $data) {
		// remove all relationships before
		SkillQuery::create()->filterByVariationOf($model)->delete();

		// add them
		$errors = [];
		foreach ($data as $entry) {
			if (!isset($entry['id'])) {
				$errors[] = 'Missing id for Skill';
			} else {
				$related = SkillQuery::create()->findOneById($entry['id']);
				$model->addVariation($related);
			}
		}

		if (count($errors) > 0) {
			throw new ErrorsException($errors);
		}
	}

	/**
	 * Internal update mechanism of Videos on Skill
	 * 
	 * @param Skill $model
	 * @param mixed $data
	 */
	protected function doUpdateVideos(Skill $model, $data) {
		// remove all relationships before
		VideoQuery::create()->filterBySkill($model)->delete();

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
