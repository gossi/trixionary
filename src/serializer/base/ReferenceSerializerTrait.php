<?php
namespace gossi\trixionary\serializer\base;

use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Video;
use gossi\trixionary\serializer\TypeInferencer;
use keeko\framework\utils\HydrateUtils;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;

/**
 */
trait ReferenceSerializerTrait {

	/**
	 */
	private $methodNames = [
		'videos' => 'Video',
		'skills' => 'Skill'
	];

	/**
	 */
	private $methodPluralNames = [
		'videos' => 'Videos',
		'skills' => 'Skills'
	];

	/**
	 * @param mixed $model
	 * @param array $fields
	 */
	public function getAttributes($model, array $fields = null) {
		return [
			'type' => $model->getType(),
			'title' => $model->getTitle(),
			'year' => $model->getYear(),
			'publisher' => $model->getPublisher(),
			'journal' => $model->getJournal(),
			'number' => $model->getNumber(),
			'school' => $model->getSchool(),
			'author' => $model->getAuthor(),
			'edition' => $model->getEdition(),
			'volume' => $model->getVolume(),
			'address' => $model->getAddress(),
			'editor' => $model->getEditor(),
			'howpublished' => $model->getHowpublished(),
			'note' => $model->getNote(),
			'booktitle' => $model->getBooktitle(),
			'pages' => $model->getPages(),
			'url' => $model->getUrl(),
			'lastchecked' => $model->getLastchecked(\DateTime::ISO8601),
			'managed' => $model->getManaged()
		];
	}

	/**
	 */
	public function getFields() {
		return ['type', 'title', 'year', 'publisher', 'journal', 'number', 'school', 'author', 'edition', 'volume', 'address', 'editor', 'howpublished', 'note', 'booktitle', 'pages', 'url', 'lastchecked', 'managed'];
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
			'videos' => Video::getSerializer()->getType(null),
			'skills' => Skill::getSerializer()->getType(null)
		];
	}

	/**
	 */
	public function getSortFields() {
		return ['type', 'title', 'year', 'publisher', 'journal', 'number', 'school', 'author', 'edition', 'volume', 'address', 'editor', 'howpublished', 'note', 'booktitle', 'pages', 'url', 'lastchecked', 'managed'];
	}

	/**
	 * @param mixed $model
	 * @return string
	 */
	public function getType($model) {
		return 'gossi.trixionary/reference';
	}

	/**
	 * @param mixed $model
	 * @param mixed $data
	 * @return mixed The model
	 */
	public function hydrate($model, $data) {
		// attributes
		$attribs = isset($data['attributes']) ? $data['attributes'] : [];

		$model = HydrateUtils::hydrate($attribs, $model, ['id', 'type', 'title', 'year', 'publisher', 'journal', 'number', 'school', 'author', 'edition', 'volume', 'address', 'editor', 'howpublished', 'note', 'booktitle', 'pages', 'url', 'lastchecked', 'managed']);

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
	public function videos($model) {
		$method = 'get' . $this->getCollectionMethodPluralName('videos');
		$relationship = new Relationship(new Collection($model->$method(), Video::getSerializer()));
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
