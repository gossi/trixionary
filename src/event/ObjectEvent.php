<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Object;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class ObjectEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.object.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.object.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.object.post_save';

	/**
	 */
	const POST_SKILLS_ADD = 'gossi.trixionary.object.post_skills_add';

	/**
	 */
	const POST_SKILLS_REMOVE = 'gossi.trixionary.object.post_skills_add';

	/**
	 */
	const POST_SKILLS_UPDATE = 'gossi.trixionary.object.post_skills_update';

	/**
	 */
	const POST_SPORT_UPDATE = 'gossi.trixionary.object.post_sport_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.object.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.object.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.object.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.object.pre_save';

	/**
	 */
	const PRE_SKILLS_ADD = 'gossi.trixionary.object.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_REMOVE = 'gossi.trixionary.object.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_UPDATE = 'gossi.trixionary.object.pre_skills_update';

	/**
	 */
	const PRE_SPORT_UPDATE = 'gossi.trixionary.object.pre_sport_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.object.pre_update';

	/**
	 */
	protected $object;

	/**
	 * @param Object $object
	 */
	public function __construct(Object $object) {
		$this->object = $object;
	}

	/**
	 * @return Object
	 */
	public function getObject() {
		return $this->object;
	}
}
