<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\SkillReference;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class SkillReferenceEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.skill_reference.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.skill_reference.post_delete';

	/**
	 */
	const POST_REFERENCE_UPDATE = 'gossi.trixionary.skill_reference.post_reference_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.skill_reference.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.skill_reference.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.skill_reference.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.skill_reference.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.skill_reference.pre_delete';

	/**
	 */
	const PRE_REFERENCE_UPDATE = 'gossi.trixionary.skill_reference.pre_reference_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.skill_reference.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.skill_reference.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.skill_reference.pre_update';

	/**
	 */
	protected $skillReference;

	/**
	 * @param SkillReference $skillReference
	 */
	public function __construct(SkillReference $skillReference) {
		$this->skillReference = $skillReference;
	}

	/**
	 * @return SkillReference
	 */
	public function getSkillReference() {
		return $this->skillReference;
	}
}
