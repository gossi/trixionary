<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Lineage;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class LineageEvent extends Event {

	/**
	 */
	const POST_ANCESTOR_UPDATE = 'gossi.trixionary.lineage.post_ancestor_update';

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.lineage.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.lineage.post_delete';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.lineage.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.lineage.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.lineage.post_update';

	/**
	 */
	const PRE_ANCESTOR_UPDATE = 'gossi.trixionary.lineage.pre_ancestor_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.lineage.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.lineage.pre_delete';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.lineage.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.lineage.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.lineage.pre_update';

	/**
	 */
	protected $lineage;

	/**
	 * @param Lineage $lineage
	 */
	public function __construct(Lineage $lineage) {
		$this->lineage = $lineage;
	}

	/**
	 * @return Lineage
	 */
	public function getLineage() {
		return $this->lineage;
	}
}
