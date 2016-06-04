<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\FunctionPhase;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class FunctionPhaseEvent extends Event {

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.function_phase.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.function_phase.post_delete';

	/**
	 */
	const POST_ROOT_SKILLS_ADD = 'gossi.trixionary.function_phase.post_root_skills_add';

	/**
	 */
	const POST_ROOT_SKILLS_REMOVE = 'gossi.trixionary.function_phase.post_root_skills_add';

	/**
	 */
	const POST_ROOT_SKILLS_UPDATE = 'gossi.trixionary.function_phase.post_root_skills_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.function_phase.post_save';

	/**
	 */
	const POST_SKILL_UPDATE = 'gossi.trixionary.function_phase.post_skill_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.function_phase.post_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.function_phase.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.function_phase.pre_delete';

	/**
	 */
	const PRE_ROOT_SKILLS_ADD = 'gossi.trixionary.function_phase.pre_root_skills_add';

	/**
	 */
	const PRE_ROOT_SKILLS_REMOVE = 'gossi.trixionary.function_phase.pre_root_skills_add';

	/**
	 */
	const PRE_ROOT_SKILLS_UPDATE = 'gossi.trixionary.function_phase.pre_root_skills_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.function_phase.pre_save';

	/**
	 */
	const PRE_SKILL_UPDATE = 'gossi.trixionary.function_phase.pre_skill_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.function_phase.pre_update';

	/**
	 */
	protected $functionPhase;

	/**
	 * @param FunctionPhase $functionPhase
	 */
	public function __construct(FunctionPhase $functionPhase) {
		$this->functionPhase = $functionPhase;
	}

	/**
	 * @return FunctionPhase
	 */
	public function getFunctionPhase() {
		return $this->functionPhase;
	}
}
