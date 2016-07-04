<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Reference;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class ReferenceEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.reference.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.reference.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.reference.post_save';

	/**
	 */
	const POST_SKILLS_ADD = 'gossi.trixionary.reference.post_skills_add';

	/**
	 */
	const POST_SKILLS_REMOVE = 'gossi.trixionary.reference.post_skills_add';

	/**
	 */
	const POST_SKILLS_UPDATE = 'gossi.trixionary.reference.post_skills_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.reference.post_update';

	/**
	 */
	const POST_VIDEOS_ADD = 'gossi.trixionary.reference.post_videos_add';

	/**
	 */
	const POST_VIDEOS_REMOVE = 'gossi.trixionary.reference.post_videos_add';

	/**
	 */
	const POST_VIDEOS_UPDATE = 'gossi.trixionary.reference.post_videos_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.reference.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.reference.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.reference.pre_save';

	/**
	 */
	const PRE_SKILLS_ADD = 'gossi.trixionary.reference.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_REMOVE = 'gossi.trixionary.reference.pre_skills_add';

	/**
	 */
	const PRE_SKILLS_UPDATE = 'gossi.trixionary.reference.pre_skills_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.reference.pre_update';

	/**
	 */
	const PRE_VIDEOS_ADD = 'gossi.trixionary.reference.pre_videos_add';

	/**
	 */
	const PRE_VIDEOS_REMOVE = 'gossi.trixionary.reference.pre_videos_add';

	/**
	 */
	const PRE_VIDEOS_UPDATE = 'gossi.trixionary.reference.pre_videos_update';

	/**
	 */
	protected $reference;

	/**
	 * @param Reference $reference
	 */
	public function __construct(Reference $reference) {
		$this->reference = $reference;
	}

	/**
	 * @return Reference
	 */
	public function getReference() {
		return $this->reference;
	}
}
