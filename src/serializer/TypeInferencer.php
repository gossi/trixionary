<?php
namespace gossi\trixionary\serializer;

use keeko\framework\model\TypeInferencerInterface;

/**
 */
class TypeInferencer implements TypeInferencerInterface {

	/**
	 */
	private static $instance;

	/**
	 */
	private $types = [
		'gossi.trixionary/sport' => [
			'modelClass' => 'gossi\trixionary\model\Sport',
			'queryClass' => 'gossi\trixionary\model\SportQuery'
		],
		'gossi.trixionary/sports' => [
			'modelClass' => 'gossi\trixionary\model\Sport',
			'queryClass' => 'gossi\trixionary\model\SportQuery'
		],
		'gossi.trixionary/object' => [
			'modelClass' => 'gossi\trixionary\model\Object',
			'queryClass' => 'gossi\trixionary\model\ObjectQuery'
		],
		'gossi.trixionary/objects' => [
			'modelClass' => 'gossi\trixionary\model\Object',
			'queryClass' => 'gossi\trixionary\model\ObjectQuery'
		],
		'gossi.trixionary/position' => [
			'modelClass' => 'gossi\trixionary\model\Position',
			'queryClass' => 'gossi\trixionary\model\PositionQuery'
		],
		'gossi.trixionary/positions' => [
			'modelClass' => 'gossi\trixionary\model\Position',
			'queryClass' => 'gossi\trixionary\model\PositionQuery'
		],
		'gossi.trixionary/skill' => [
			'modelClass' => 'gossi\trixionary\model\Skill',
			'queryClass' => 'gossi\trixionary\model\SkillQuery'
		],
		'gossi.trixionary/skills' => [
			'modelClass' => 'gossi\trixionary\model\Skill',
			'queryClass' => 'gossi\trixionary\model\SkillQuery'
		],
		'gossi.trixionary/lineage' => [
			'modelClass' => 'gossi\trixionary\model\Lineage',
			'queryClass' => 'gossi\trixionary\model\LineageQuery'
		],
		'gossi.trixionary/lineages' => [
			'modelClass' => 'gossi\trixionary\model\Lineage',
			'queryClass' => 'gossi\trixionary\model\LineageQuery'
		],
		'gossi.trixionary/group' => [
			'modelClass' => 'gossi\trixionary\model\Group',
			'queryClass' => 'gossi\trixionary\model\GroupQuery'
		],
		'gossi.trixionary/groups' => [
			'modelClass' => 'gossi\trixionary\model\Group',
			'queryClass' => 'gossi\trixionary\model\GroupQuery'
		],
		'gossi.trixionary/picture' => [
			'modelClass' => 'gossi\trixionary\model\Picture',
			'queryClass' => 'gossi\trixionary\model\PictureQuery'
		],
		'gossi.trixionary/pictures' => [
			'modelClass' => 'gossi\trixionary\model\Picture',
			'queryClass' => 'gossi\trixionary\model\PictureQuery'
		],
		'gossi.trixionary/video' => [
			'modelClass' => 'gossi\trixionary\model\Video',
			'queryClass' => 'gossi\trixionary\model\VideoQuery'
		],
		'gossi.trixionary/videos' => [
			'modelClass' => 'gossi\trixionary\model\Video',
			'queryClass' => 'gossi\trixionary\model\VideoQuery'
		],
		'gossi.trixionary/reference' => [
			'modelClass' => 'gossi\trixionary\model\Reference',
			'queryClass' => 'gossi\trixionary\model\ReferenceQuery'
		],
		'gossi.trixionary/references' => [
			'modelClass' => 'gossi\trixionary\model\Reference',
			'queryClass' => 'gossi\trixionary\model\ReferenceQuery'
		],
		'gossi.trixionary/kstruktur' => [
			'modelClass' => 'gossi\trixionary\model\Kstruktur',
			'queryClass' => 'gossi\trixionary\model\KstrukturQuery'
		],
		'gossi.trixionary/kstrukturs' => [
			'modelClass' => 'gossi\trixionary\model\Kstruktur',
			'queryClass' => 'gossi\trixionary\model\KstrukturQuery'
		],
		'gossi.trixionary/function-phase' => [
			'modelClass' => 'gossi\trixionary\model\FunctionPhase',
			'queryClass' => 'gossi\trixionary\model\FunctionPhaseQuery'
		],
		'gossi.trixionary/function-phases' => [
			'modelClass' => 'gossi\trixionary\model\FunctionPhase',
			'queryClass' => 'gossi\trixionary\model\FunctionPhaseQuery'
		]
	];

	/**
	 */
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param mixed $type
	 */
	public function getModelClass($type) {
		if (isset($this->types[$type]) && isset($this->types[$type]['modelClass'])) {
			return $this->types[$type]['modelClass'];
		}
	}

	/**
	 * @param mixed $type
	 */
	public function getQueryClass($type) {
		if (isset($this->types[$type]) && isset($this->types[$type]['queryClass'])) {
			return $this->types[$type]['queryClass'];
		}
	}

	/**
	 */
	private function __construct() {
	}
}
