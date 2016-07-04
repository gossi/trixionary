<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use gossi\trixionary\serializer\TypeInferencer;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

/**
 */
trait GroupSerializerTrait {

	/**
	 */
	private $methodNames = [
		'skills' => 'Skill'
	];

	/**
	 */
	private $methodPluralNames = [
		'skills' => 'Skills'
	];

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'title' => $model->getTitle(),
			'description' => $model->getDescription(),
			'slug' => $model->getSlug(),
			'skill-count' => $model->getSkillCount()
		];
	}

	/**
	 */
	public function getFields() {
		return ['title', 'description', 'slug', 'skill-count'];
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
			'sport' => Sport::getSerializer()->getType(null),
			'skills' => Skill::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['title', 'description', 'slug', 'skill-count'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/group';
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'title', 'description', 'slug', 'sport-id']);

		// relationships
		//$this->hydrateRelationships($model, $data);

		return $model;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function skills($model) {
		$method = 'get' . $this->getCollectionMethodPluralName('skills');
		$relationship = new Relationship(new Collection($model->$method(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'skill');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function sport($model) {
		$serializer = Sport::getSerializer();
		$id = $serializer->getId($model->getSport());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getSport(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'sport');
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
	 * @param mixed $relatedName
	 */
	protected function getCollectionMethodName($relatedName) {
		if (isset($this->methodNames[$relatedName])) {
			return $this->methodNames[$relatedName];
		}
		return null;
	}

	/**
	 * @param mixed $relatedName
	 */
	protected function getCollectionMethodPluralName($relatedName) {
		if (isset($this->methodPluralNames[$relatedName])) {
			return $this->methodPluralNames[$relatedName];
		}
		return null;
	}

	/**
	 */
	protected function getTypeInferencer() {
		return TypeInferencer::getInstance();
	}
}
