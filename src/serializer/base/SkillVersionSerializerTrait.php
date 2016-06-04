<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\Skill;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

/**
 */
trait SkillVersionSerializerTrait {

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'sport-id' => $model->getSportId(),
			'name' => $model->getName(),
			'alternative-name' => $model->getAlternativeName(),
			'slug' => $model->getSlug(),
			'description' => $model->getDescription(),
			'history' => $model->getHistory(),
			'is-translation' => $model->getIsTranslation(),
			'is-rotation' => $model->getIsRotation(),
			'is-cyclic' => $model->getIsCyclic(),
			'longitudinal-flags' => $model->getLongitudinalFlags(),
			'latitudinal-flags' => $model->getLatitudinalFlags(),
			'transversal-flags' => $model->getTransversalFlags(),
			'movement-description' => $model->getMovementDescription(),
			'variation-of-id' => $model->getVariationOfId(),
			'start-position-id' => $model->getStartPositionId(),
			'end-position-id' => $model->getEndPositionId(),
			'is-composite' => $model->getIsComposite(),
			'is-multiple' => $model->getIsMultiple(),
			'multiple-of-id' => $model->getMultipleOfId(),
			'multiplier' => $model->getMultiplier(),
			'generation' => $model->getGeneration(),
			'importance' => $model->getImportance(),
			'generation-ids' => $model->getGenerationIds(),
			'picture-id' => $model->getPictureId(),
			'kstruktur-id' => $model->getKstrukturId(),
			'function-phase-id' => $model->getFunctionPhaseId(),
			'version-created-at' => $model->getVersionCreatedAt(\DateTime::ISO8601),
			'version-comment' => $model->getVersionComment(),
			'variation-of-id-version' => $model->getVariationOfIdVersion(),
			'multiple-of-id-version' => $model->getMultipleOfIdVersion(),
			'kk-trixionary-skill-ids' => $model->getKkTrixionarySkillIds(),
			'kk-trixionary-skill-versions' => $model->getKkTrixionarySkillVersions()
		];
	}

	/**
	 */
	public function getFields() {
		return ['sport-id', 'name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'variation-of-id', 'start-position-id', 'end-position-id', 'is-composite', 'is-multiple', 'multiple-of-id', 'multiplier', 'generation', 'importance', 'generation-ids', 'picture-id', 'kstruktur-id', 'function-phase-id', 'version-created-at', 'version-comment', 'variation-of-id-version', 'multiple-of-id-version', 'kk-trixionary-skill-ids', 'kk-trixionary-skill-versions'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getId($model) {
		if ($model !== null) {
			return $model->getId();
		}

		return null;
	}

	/**
	 */
	public function getRelationships() {
		return [
			'skill' => Skill::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['sport-id', 'name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'variation-of-id', 'start-position-id', 'end-position-id', 'is-composite', 'is-multiple', 'multiple-of-id', 'multiplier', 'generation', 'importance', 'generation-ids', 'picture-id', 'kstruktur-id', 'function-phase-id', 'version-created-at', 'version-comment', 'variation-of-id-version', 'multiple-of-id-version', 'kk-trixionary-skill-ids', 'kk-trixionary-skill-versions'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/skill-version';
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'sport-id', 'name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'variation-of-id', 'start-position-id', 'end-position-id', 'is-composite', 'is-multiple', 'multiple-of-id', 'multiplier', 'generation', 'importance', 'generation-ids', 'picture-id', 'kstruktur-id', 'function-phase-id', 'version', 'version-created-at', 'version-comment', 'variation-of-id-version', 'multiple-of-id-version', 'kk-trixionary-skill-ids', 'kk-trixionary-skill-versions']);

		// relationships
		$this->hydrateRelationships($model, $data);

		return $model;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function skill($model) {
		$serializer = Skill::getSerializer();
		$id = $serializer->getId($model->getSkill());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getSkill(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'skill');
		}

		return null;
	}

	/**
	 * @param Relationship $relationship
	 * @param mixed $model
	 * @param string $related
	 * @return Relationship
	 */
	abstract protected function addRelationshipSelfLink(Relationship $relationship, $model, $related);

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return void
	 */
	abstract protected function hydrateRelationships($model, $data);
}
