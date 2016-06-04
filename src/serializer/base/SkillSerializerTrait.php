<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\FunctionPhase;
use gossi\trixionary\model\Group;
use gossi\trixionary\model\Kstruktur;
use gossi\trixionary\model\Object;
use gossi\trixionary\model\Picture;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Reference;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use gossi\trixionary\model\Video;
use gossi\trixionary\serializer\TypeInferencer;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

/**
 */
trait SkillSerializerTrait {

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function descendents($model) {
		$relationship = new Relationship(new Collection($model->getDescendents(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'descendent');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function endPosition($model) {
		$serializer = Position::getSerializer();
		$id = $serializer->getId($model->getEndPosition());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getEndPosition(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'end-position');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function featuredPicture($model) {
		$serializer = Picture::getSerializer();
		$id = $serializer->getId($model->getFeaturedPicture());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getFeaturedPicture(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'featured-picture');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function functionPhaseRoot($model) {
		$serializer = FunctionPhase::getSerializer();
		$id = $serializer->getId($model->getFunctionPhaseRoot());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getFunctionPhaseRoot(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'function-phase-root');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function functionPhases($model) {
		$relationship = new Relationship(new Collection($model->getFunctionPhases(), FunctionPhase::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'function-phase');
	}

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
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
			'is-composite' => $model->getIsComposite(),
			'is-multiple' => $model->getIsMultiple(),
			'multiplier' => $model->getMultiplier(),
			'generation' => $model->getGeneration(),
			'importance' => $model->getImportance(),
			'generation-ids' => $model->getGenerationIds(),
			'version' => $model->getVersion(),
			'version-created-at' => $model->getVersionCreatedAt(\DateTime::ISO8601),
			'version-comment' => $model->getVersionComment()
		];
	}

	/**
	 */
	public function getFields() {
		return ['name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'is-composite', 'is-multiple', 'multiplier', 'generation', 'importance', 'generation-ids', 'version', 'version-created-at', 'version-comment'];
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
			'variations' => Skill::getSerializer()->getType(null),
			'variation-of' => Skill::getSerializer()->getType(null),
			'multiples' => Skill::getSerializer()->getType(null),
			'multiple-of' => Skill::getSerializer()->getType(null),
			'object' => Object::getSerializer()->getType(null),
			'start-position' => Position::getSerializer()->getType(null),
			'end-position' => Position::getSerializer()->getType(null),
			'featured-picture' => Picture::getSerializer()->getType(null),
			'kstruktur-root' => Kstruktur::getSerializer()->getType(null),
			'function-phase-root' => FunctionPhase::getSerializer()->getType(null),
			'descendents' => Skill::getSerializer()->getType(null),
			'parts' => Skill::getSerializer()->getType(null),
			'groups' => Group::getSerializer()->getType(null),
			'pictures' => Picture::getSerializer()->getType(null),
			'videos' => Video::getSerializer()->getType(null),
			'references' => Reference::getSerializer()->getType(null),
			'kstrukturs' => Kstruktur::getSerializer()->getType(null),
			'function-phases' => FunctionPhase::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'is-composite', 'is-multiple', 'multiplier', 'generation', 'importance', 'generation-ids', 'version', 'version-created-at', 'version-comment'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/skill';
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

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'sport-id', 'name', 'alternative-name', 'slug', 'description', 'history', 'is-translation', 'is-rotation', 'is-cyclic', 'longitudinal-flags', 'latitudinal-flags', 'transversal-flags', 'movement-description', 'variation-of-id', 'start-position-id', 'end-position-id', 'is-composite', 'is-multiple', 'multiple-of-id', 'multiplier', 'generation', 'importance', 'generation-ids', 'picture-id', 'kstruktur-id', 'function-phase-id', 'object-id', 'version', 'version-created-at', 'version-comment']);

		// relationships
		$this->hydrateRelationships($model, $data);

		return $model;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function kstrukturRoot($model) {
		$serializer = Kstruktur::getSerializer();
		$id = $serializer->getId($model->getKstrukturRoot());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getKstrukturRoot(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'kstruktur-root');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function kstrukturs($model) {
		$relationship = new Relationship(new Collection($model->getKstrukturs(), Kstruktur::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'kstruktur');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function multipleOf($model) {
		$serializer = Skill::getSerializer();
		$id = $serializer->getId($model->getMultipleOf());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getMultipleOf(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'multiple-of');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function multiples($model) {
		$relationship = new Relationship(new Collection($model->getMultiples(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'multiple');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function object($model) {
		$serializer = Object::getSerializer();
		$id = $serializer->getId($model->getObject());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getObject(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'object');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function parts($model) {
		$relationship = new Relationship(new Collection($model->getParts(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'part');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function pictures($model) {
		$relationship = new Relationship(new Collection($model->getPictures(), Picture::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'picture');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function references($model) {
		$relationship = new Relationship(new Collection($model->getReferences(), Reference::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'reference');
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
	 * @param mixed $model
	 * @return Relationship
	 */
	public function startPosition($model) {
		$serializer = Position::getSerializer();
		$id = $serializer->getId($model->getStartPosition());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getStartPosition(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'start-position');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function variationOf($model) {
		$serializer = Skill::getSerializer();
		$id = $serializer->getId($model->getVariationOf());
		if ($id !== null) {
			$relationship = new Relationship(new Resource($model->getVariationOf(), $serializer));
			$relationship->setLinks([
				'related' => '%apiurl%' . $serializer->getType(null) . '/' . $id 
			]);
			return $this->addRelationshipSelfLink($relationship, $model, 'variation-of');
		}

		return null;
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function variations($model) {
		$relationship = new Relationship(new Collection($model->getVariations(), Skill::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'variation');
	}

	/**
	 * @param mixed $model
	 * @return Relationship
	 */
	public function videos($model) {
		$relationship = new Relationship(new Collection($model->getVideos(), Video::getSerializer()));
		return $this->addRelationshipSelfLink($relationship, $model, 'video');
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