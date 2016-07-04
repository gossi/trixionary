<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Video;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class VideoEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.video.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.video.post_delete';

	/**
	 */
	const POST_REFERENCE_UPDATE = 'gossi.trixionary.video.post_reference_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.video.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.video.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.video.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.video.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.video.pre_delete';

	/**
	 */
	const PRE_REFERENCE_UPDATE = 'gossi.trixionary.video.pre_reference_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.video.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.video.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.video.pre_update';

	/**
	 */
	protected $video;

	/**
	 * @param Video $video
	 */
	public function __construct(Video $video) {
		$this->video = $video;
	}

	/**
	 * @return Video
	 */
	public function getVideo() {
		return $this->video;
	}
}
