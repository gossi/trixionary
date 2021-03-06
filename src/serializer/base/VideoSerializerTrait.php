<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\Reference;
use gossi\trixionary\model\Skill;
use gossi\trixionary\serializer\TypeInferencer;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

/**
 */
trait VideoSerializerTrait {

	/**
	 */
	private $methodNames = [
		'featured-skills' => 'FeaturedSkill',
		'featured-tutorial-skills' => 'FeaturedTutorialSkill'
	];

	/**
	 */
	private $methodPluralNames = [
		'featured-skills' => 'FeaturedSkills',
		'featured-tutorial-skills' => 'FeaturedTutorialSkills'
	];

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function featuredSkills($model) {
		$method = 'get' . $this->getCollectionMethodPluralName('featured-skills');
		$relationship = new Relationship(new Collection($model->$method(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'featured-skill');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function featuredTutorialSkills($model) {
		$method = 'get' . $this->getCollectionMethodPluralName('featured-tutorial-skills');
		$relationship = new Relationship(new Collection($model->$method(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'featured-tutorial-skill');
	}

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'title' => $model->getTitle(),
			'description' => $model->getDescription(),
			'url' => $model->getUrl(),
			'is-tutorial' => $model->getIsTutorial(),
			'athlete' => $model->getAthlete(),
			'athlete-id' => $model->getAthleteId(),
			'uploader-id' => $model->getUploaderId(),
			'poster-url' => $model->getPosterUrl(),
			'provider' => $model->getProvider(),
			'provider-id' => $model->getProviderId(),
			'player-url' => $model->getPlayerUrl(),
			'width' => $model->getWidth(),
			'height' => $model->getHeight()
		];
	}

	/**
	 */
	public function getFields() {
		return ['title', 'description', 'url', 'is-tutorial', 'athlete', 'athlete-id', 'uploader-id', 'poster-url', 'provider', 'provider-id', 'player-url', 'width', 'height'];
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
			'featured-skills' => Skill::getSerializer()->getType(null),
			'featured-tutorial-skills' => Skill::getSerializer()->getType(null),
			'skill' => Skill::getSerializer()->getType(null),
			'reference' => Reference::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['title', 'description', 'url', 'is-tutorial', 'athlete', 'athlete-id', 'uploader-id', 'poster-url', 'provider', 'provider-id', 'player-url', 'width', 'height'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/video';
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'title', 'description', 'url', 'is-tutorial', 'athlete', 'athlete-id', 'uploader-id', 'skill-id', 'reference-id', 'poster-url', 'provider', 'provider-id', 'player-url', 'width', 'height']);

		// relationships
		//$this->hydrateRelationships($model, $data);

		return $model;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function reference($model) {
		$serializer = Reference::getSerializer();
		$id = $serializer->getId($model->getReference());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getReference(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'reference');
		}

		return null;
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
