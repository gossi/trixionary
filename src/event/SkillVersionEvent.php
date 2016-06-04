<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\SkillVersion;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class SkillVersionEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.skill_version.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.skill_version.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.skill_version.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.skill_version.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.skill_version.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.skill_version.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.skill_version.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.skill_version.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.skill_version.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.skill_version.pre_update';

	/**
	 */
	protected $skillVersion;

	/**
	 * @param SkillVersion $skillVersion
	 */
	public function __construct(SkillVersion $skillVersion) {
		$this->skillVersion = $skillVersion;
	}

	/**
	 * @return SkillVersion
	 */
	public function getSkillVersion() {
		return $this->skillVersion;
	}
}
