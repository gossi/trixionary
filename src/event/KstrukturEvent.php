<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Kstruktur;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class KstrukturEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.kstruktur.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.kstruktur.post_delete';

	/**
	 */
	const POST_ROOT_SKILLS_ADD = 'gossi.trixionary.kstruktur.post_root_skills_add';

	/**
	 */
	const POST_ROOT_SKILLS_REMOVE = 'gossi.trixionary.kstruktur.post_root_skills_add';

	/**
	 */
	const POST_ROOT_SKILLS_UPDATE = 'gossi.trixionary.kstruktur.post_root_skills_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.kstruktur.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.kstruktur.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.kstruktur.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.kstruktur.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.kstruktur.pre_delete';

	/**
	 */
	const PRE_ROOT_SKILLS_ADD = 'gossi.trixionary.kstruktur.pre_root_skills_add';

	/**
	 */
	const PRE_ROOT_SKILLS_REMOVE = 'gossi.trixionary.kstruktur.pre_root_skills_add';

	/**
	 */
	const PRE_ROOT_SKILLS_UPDATE = 'gossi.trixionary.kstruktur.pre_root_skills_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.kstruktur.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.kstruktur.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.kstruktur.pre_update';

	/**
	 */
	protected $kstruktur;

	/**
	 * @param Kstruktur $kstruktur
	 */
	public function __construct(Kstruktur $kstruktur) {
		$this->kstruktur = $kstruktur;
	}

	/**
	 * @return Kstruktur
	 */
	public function getKstruktur() {
		return $this->kstruktur;
	}
}
