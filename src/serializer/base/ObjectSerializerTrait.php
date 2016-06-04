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
trait ObjectSerializerTrait {

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'title' => $model->getTitle(),
			'slug' => $model->getSlug(),
			'fixed' => $model->getFixed(),
			'description' => $model->getDescription()
		];
	}

	/**
	 */
	public function getFields() {
		return ['title', 'slug', 'fixed', 'description'];
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
		return ['title', 'slug', 'fixed', 'description'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/object';
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'title', 'slug', 'fixed', 'description', 'sport-id']);

		// relationships
		$this->hydrateRelationships($model, $data);

		return $model;
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
