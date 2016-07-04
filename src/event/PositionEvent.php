<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Position;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class PositionEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.position.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.position.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.position.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.position.post_skill_update';

	/**
	 */
	const POST_SPORT_UPDATE = 'gossi.trixionary.position.post_sport_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.position.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.position.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.position.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.position.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.position.pre_skill_update';

	/**
	 */
	const PRE_SPORT_UPDATE = 'gossi.trixionary.position.pre_sport_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.position.pre_update';

	/**
	 */
	protected $position;

	/**
	 * @param Position $position
	 */
	public function __construct(Position $position) {
		$this->position = $position;
	}

	/**
	 * @return Position
	 */
	public function getPosition() {
		return $this->position;
	}
}
