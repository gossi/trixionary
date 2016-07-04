<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Sport;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class SportEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.sport.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.sport.post_delete';

	/**
	 */
	const POST_GROUPS_ADD = 'gossi.trixionary.sport.post_groups_add';

	/**
	 */
	const POST_GROUPS_REMOVE = 'gossi.trixionary.sport.post_groups_add';

	/**
	 */
	const POST_GROUPS_UPDATE = 'gossi.trixionary.sport.post_groups_update';

	/**
	 */
	const POST_OBJECTS_ADD = 'gossi.trixionary.sport.post_objects_add';

	/**
	 */
	const POST_OBJECTS_REMOVE = 'gossi.trixionary.sport.post_objects_add';

	/**
	 */
	const POST_OBJECTS_UPDATE = 'gossi.trixionary.sport.post_objects_update';

	/**
	 */
	const POST_POSITIONS_ADD = 'gossi.trixionary.sport.post_positions_add';

	/**
	 */
	const POST_POSITIONS_REMOVE = 'gossi.trixionary.sport.post_positions_add';

	/**
	 */
	const POST_POSITIONS_UPDATE = 'gossi.trixionary.sport.post_positions_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.sport.post_save';

	/**
	 */
	const POST_SKILLS_ADD = 'gossi.trixionary.sport.post_skills_add';

	/**
	 */
	const POST_SKILLS_REMOVE = 'gossi.trixionary.sport.post_skills_add';

	/**
	 */
	const POST_SKILLS_UPDATE = 'gossi.trixionary.sport.post_skills_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.sport.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.sport.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.sport.pre_delete';

	/**
	 */
	const PRE_GROUPS_ADD = 'gossi.trixionary.sport.pre_groups_add';

	/**
	 */
	const PRE_GROUPS_REMOVE = 'gossi.trixionary.sport.pre_groups_add';

	/**
	 */
	const PRE_GROUPS_UPDATE = 'gossi.trixionary.sport.pre_groups_update';

	/**
	 */
	const PRE_OBJECTS_ADD = 'gossi.trixionary.sport.pre_objects_add';

	/**
	 */
	const PRE_OBJECTS_REMOVE = 'gossi.trixionary.sport.pre_objects_add';

	/**
	 */
	const PRE_OBJECTS_UPDATE = 'gossi.trixionary.sport.pre_objects_update';

	/**
	 */
	const PRE_POSITIONS_ADD = 'gossi.trixionary.sport.pre_positions_add';

	/**
	 */
	const PRE_POSITIONS_REMOVE = 'gossi.trixionary.sport.pre_positions_add';

	/**
	 */
	const PRE_POSITIONS_UPDATE = 'gossi.trixionary.sport.pre_positions_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.sport.pre_save';

	/**
	 */
	const PRE_SKILLS_ADD = 'gossi.trixionary.sport.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_REMOVE = 'gossi.trixionary.sport.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_UPDATE = 'gossi.trixionary.sport.pre_skills_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.sport.pre_update';

	/**
	 */
	protected $sport;

	/**
	 * @param Sport $sport
	 */
	public function __construct(Sport $sport) {
		$this->sport = $sport;
	}

	/**
	 * @return Sport
	 */
	public function getSport() {
		return $this->sport;
	}
}
