<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\Group;
use gossi\trixionary\model\Object;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Skill;
use gossi\trixionary\serializer\TypeInferencer;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;

/**
 */
trait SportSerializerTrait {

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'title' => $model->getTitle(),
			'slug' => $model->getSlug(),
			'athlete-label' => $model->getAthleteLabel(),
			'object-slug' => $model->getObjectSlug(),
			'object-label' => $model->getObjectLabel(),
			'object-plural-label' => $model->getObjectPluralLabel(),
			'skill-slug' => $model->getSkillSlug(),
			'skill-label' => $model->getSkillLabel(),
			'skill-plural-label' => $model->getSkillPluralLabel(),
			'group-slug' => $model->getGroupSlug(),
			'group-label' => $model->getGroupLabel(),
			'group-plural-label' => $model->getGroupPluralLabel(),
			'transition-label' => $model->getTransitionLabel(),
			'transition-plural-label' => $model->getTransitionPluralLabel(),
			'transitions-slug' => $model->getTransitionsSlug(),
			'position-slug' => $model->getPositionSlug(),
			'position-label' => $model->getPositionLabel(),
			'feature-composition' => $model->getFeatureComposition(),
			'feature-tester' => $model->getFeatureTester(),
			'is-default' => $model->getIsDefault()
		];
	}

	/**
	 */
	public function getFields() {
		return ['title', 'slug', 'athlete-label', 'object-slug', 'object-label', 'object-plural-label', 'skill-slug', 'skill-label', 'skill-plural-label', 'group-slug', 'group-label', 'group-plural-label', 'transition-label', 'transition-plural-label', 'transitions-slug', 'position-slug', 'position-label', 'feature-composition', 'feature-tester', 'is-default'];
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
			'objects' => Object::getSerializer()->getType(null),
			'positions' => Position::getSerializer()->getType(null),
			'skills' => Skill::getSerializer()->getType(null),
			'groups' => Group::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['title', 'slug', 'athlete-label', 'object-slug', 'object-label', 'object-plural-label', 'skill-slug', 'skill-label', 'skill-plural-label', 'group-slug', 'group-label', 'group-plural-label', 'transition-label', 'transition-plural-label', 'transitions-slug', 'position-slug', 'position-label', 'feature-composition', 'feature-tester', 'is-default'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/sport';
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function groups($model) {
		$relationship = new Relationship(new Collection($model->getGroups(), Group::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'group');
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'title', 'slug', 'athlete-label', 'object-slug', 'object-label', 'object-plural-label', 'skill-slug', 'skill-label', 'skill-plural-label', 'group-slug', 'group-label', 'group-plural-label', 'transition-label', 'transition-plural-label', 'transitions-slug', 'position-slug', 'position-label', 'feature-composition', 'feature-tester', 'is-default']);

		// relationships
		$this->hydrateRelationships($model, $data);

		return $model;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function objects($model) {
		$relationship = new Relationship(new Collection($model->getObjects(), Object::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'object');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function positions($model) {
		$relationship = new Relationship(new Collection($model->getPositions(), Position::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'position');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function skills($model) {
		$relationship = new Relationship(new Collection($model->getSkills(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'skill');
	}

	/**
	 * @param Relationship $relationship
	 * @param mixed $model
	 * @param string $related
	 * @return Relationship
	 */
	abstract protected function addRelationshipSelfLink(Relationship $relationship, $model, $related);

	/**
	 */
	protected function getTypeInferencer() {
		return TypeInferencer::getInstance();
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return void
	 */
	abstract protected function hydrateRelationships($model, $data);
}
