<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Picture;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class PictureEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.picture.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.picture.post_delete';

	/**
	 */
	const POST_FEATURED_SKILL_UPDATE = 'gossi.trixionary.picture.post_featured_skill_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.picture.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.picture.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.picture.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.picture.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.picture.pre_delete';

	/**
	 */
	const PRE_FEATURED_SKILL_UPDATE = 'gossi.trixionary.picture.pre_featured_skill_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.picture.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.picture.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.picture.pre_update';

	/**
	 */
	protected $picture;

	/**
	 * @param Picture $picture
	 */
	public function __construct(Picture $picture) {
		$this->picture = $picture;
	}

	/**
	 * @return Picture
	 */
	public function getPicture() {
		return $this->picture;
	}
}
