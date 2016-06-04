<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Group;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class GroupEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.group.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.group.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.group.post_save';

	/**
	 */
	const POST_SKILLS_ADD = 'gossi.trixionary.group.post_skills_add';

	/**
	 */
	const POST_SKILLS_REMOVE = 'gossi.trixionary.group.post_skills_add';

	/**
	 */
	const POST_SKILLS_UPDATE = 'gossi.trixionary.group.post_skills_update';

	/**
	 */
	const POST_SPORT_UPDATE = 'gossi.trixionary.group.post_sport_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.group.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.group.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.group.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.group.pre_save';

	/**
	 */
	const PRE_SKILLS_ADD = 'gossi.trixionary.group.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_REMOVE = 'gossi.trixionary.group.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_UPDATE = 'gossi.trixionary.group.pre_skills_update';

	/**
	 */
	const PRE_SPORT_UPDATE = 'gossi.trixionary.group.pre_sport_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.group.pre_update';

	/**
	 */
	protected $group;

	/**
	 * @param Group $group
	 */
	public function __construct(Group $group) {
		$this->group = $group;
	}

	/**
	 * @return Group
	 */
	public function getGroup() {
		return $this->group;
	}
}
