<?php
namespace gossi\trixionary\event;

use gossi\trixionary\model\Skill;
use Symfony\Component\EventDispatcher\Event;

/**
 */
class SkillEvent extends Event {

	/**
	 */
	const POST_CHILDREN_ADD = 'gossi.trixionary.skill.post_children_add';

	/**
	 */
	const POST_CHILDREN_REMOVE = 'gossi.trixionary.skill.post_children_add';

	/**
	 */
	const POST_CHILDREN_UPDATE = 'gossi.trixionary.skill.post_children_update';

	/**
	 */
	const POST_CREATE = 'gossi.trixionary.skill.post_create';

	/**
	 */
	const POST_DELETE = 'gossi.trixionary.skill.post_delete';

	/**
	 */
	const POST_END_POSITION_UPDATE = 'gossi.trixionary.skill.post_end_position_update';

	/**
	 */
	const POST_FEATURED_PICTURE_UPDATE = 'gossi.trixionary.skill.post_featured_picture_update';

	/**
	 */
	const POST_FUNCTION_PHASE_ROOT_UPDATE = 'gossi.trixionary.skill.post_function_phase_root_update';

	/**
	 */
	const POST_FUNCTION_PHASES_ADD = 'gossi.trixionary.skill.post_function_phases_add';

	/**
	 */
	const POST_FUNCTION_PHASES_REMOVE = 'gossi.trixionary.skill.post_function_phases_add';

	/**
	 */
	const POST_FUNCTION_PHASES_UPDATE = 'gossi.trixionary.skill.post_function_phases_update';

	/**
	 */
	const POST_GROUPS_ADD = 'gossi.trixionary.skill.post_groups_add';

	/**
	 */
	const POST_GROUPS_REMOVE = 'gossi.trixionary.skill.post_groups_add';

	/**
	 */
	const POST_GROUPS_UPDATE = 'gossi.trixionary.skill.post_groups_update';

	/**
	 */
	const POST_KSTRUKTUR_ROOT_UPDATE = 'gossi.trixionary.skill.post_kstruktur_root_update';

	/**
	 */
	const POST_KSTRUKTURS_ADD = 'gossi.trixionary.skill.post_kstrukturs_add';

	/**
	 */
	const POST_KSTRUKTURS_REMOVE = 'gossi.trixionary.skill.post_kstrukturs_add';

	/**
	 */
	const POST_KSTRUKTURS_UPDATE = 'gossi.trixionary.skill.post_kstrukturs_update';

	/**
	 */
	const POST_LINEAGES_ADD = 'gossi.trixionary.skill.post_lineages_add';

	/**
	 */
	const POST_LINEAGES_REMOVE = 'gossi.trixionary.skill.post_lineages_add';

	/**
	 */
	const POST_LINEAGES_UPDATE = 'gossi.trixionary.skill.post_lineages_update';

	/**
	 */
	const POST_MULTIPLE_OF_UPDATE = 'gossi.trixionary.skill.post_multiple_of_update';

	/**
	 */
	const POST_MULTIPLES_ADD = 'gossi.trixionary.skill.post_multiples_add';

	/**
	 */
	const POST_MULTIPLES_REMOVE = 'gossi.trixionary.skill.post_multiples_add';

	/**
	 */
	const POST_MULTIPLES_UPDATE = 'gossi.trixionary.skill.post_multiples_update';

	/**
	 */
	const POST_OBJECT_UPDATE = 'gossi.trixionary.skill.post_object_update';

	/**
	 */
	const POST_PARTS_ADD = 'gossi.trixionary.skill.post_parts_add';

	/**
	 */
	const POST_PARTS_REMOVE = 'gossi.trixionary.skill.post_parts_add';

	/**
	 */
	const POST_PARTS_UPDATE = 'gossi.trixionary.skill.post_parts_update';

	/**
	 */
	const POST_PICTURES_ADD = 'gossi.trixionary.skill.post_pictures_add';

	/**
	 */
	const POST_PICTURES_REMOVE = 'gossi.trixionary.skill.post_pictures_add';

	/**
	 */
	const POST_PICTURES_UPDATE = 'gossi.trixionary.skill.post_pictures_update';

	/**
	 */
	const POST_REFERENCES_ADD = 'gossi.trixionary.skill.post_references_add';

	/**
	 */
	const POST_REFERENCES_REMOVE = 'gossi.trixionary.skill.post_references_add';

	/**
	 */
	const POST_REFERENCES_UPDATE = 'gossi.trixionary.skill.post_references_update';

	/**
	 */
	const POST_SAVE = 'gossi.trixionary.skill.post_save';

	/**
	 */
	const POST_SPORT_UPDATE = 'gossi.trixionary.skill.post_sport_update';

	/**
	 */
	const POST_START_POSITION_UPDATE = 'gossi.trixionary.skill.post_start_position_update';

	/**
	 */
	const POST_UPDATE = 'gossi.trixionary.skill.post_update';

	/**
	 */
	const POST_VARIATION_OF_UPDATE = 'gossi.trixionary.skill.post_variation_of_update';

	/**
	 */
	const POST_VARIATIONS_ADD = 'gossi.trixionary.skill.post_variations_add';

	/**
	 */
	const POST_VARIATIONS_REMOVE = 'gossi.trixionary.skill.post_variations_add';

	/**
	 */
	const POST_VARIATIONS_UPDATE = 'gossi.trixionary.skill.post_variations_update';

	/**
	 */
	const POST_VIDEOS_ADD = 'gossi.trixionary.skill.post_videos_add';

	/**
	 */
	const POST_VIDEOS_REMOVE = 'gossi.trixionary.skill.post_videos_add';

	/**
	 */
	const POST_VIDEOS_UPDATE = 'gossi.trixionary.skill.post_videos_update';

	/**
	 */
	const PRE_CHILDREN_ADD = 'gossi.trixionary.skill.pre_children_add';

	/**
	 */
	const PRE_CHILDREN_REMOVE = 'gossi.trixionary.skill.pre_children_add';

	/**
	 */
	const PRE_CHILDREN_UPDATE = 'gossi.trixionary.skill.pre_children_update';

	/**
	 */
	const PRE_CREATE = 'gossi.trixionary.skill.pre_create';

	/**
	 */
	const PRE_DELETE = 'gossi.trixionary.skill.pre_delete';

	/**
	 */
	const PRE_END_POSITION_UPDATE = 'gossi.trixionary.skill.pre_end_position_update';

	/**
	 */
	const PRE_FEATURED_PICTURE_UPDATE = 'gossi.trixionary.skill.pre_featured_picture_update';

	/**
	 */
	const PRE_FUNCTION_PHASE_ROOT_UPDATE = 'gossi.trixionary.skill.pre_function_phase_root_update';

	/**
	 */
	const PRE_FUNCTION_PHASES_ADD = 'gossi.trixionary.skill.pre_function_phases_add';

	/**
	 */
	const PRE_FUNCTION_PHASES_REMOVE = 'gossi.trixionary.skill.pre_function_phases_add';

	/**
	 */
	const PRE_FUNCTION_PHASES_UPDATE = 'gossi.trixionary.skill.pre_function_phases_update';

	/**
	 */
	const PRE_GROUPS_ADD = 'gossi.trixionary.skill.pre_groups_add';

	/**
	 */
	const PRE_GROUPS_REMOVE = 'gossi.trixionary.skill.pre_groups_add';

	/**
	 */
	const PRE_GROUPS_UPDATE = 'gossi.trixionary.skill.pre_groups_update';

	/**
	 */
	const PRE_KSTRUKTUR_ROOT_UPDATE = 'gossi.trixionary.skill.pre_kstruktur_root_update';

	/**
	 */
	const PRE_KSTRUKTURS_ADD = 'gossi.trixionary.skill.pre_kstrukturs_add';

	/**
	 */
	const PRE_KSTRUKTURS_REMOVE = 'gossi.trixionary.skill.pre_kstrukturs_add';

	/**
	 */
	const PRE_KSTRUKTURS_UPDATE = 'gossi.trixionary.skill.pre_kstrukturs_update';

	/**
	 */
	const PRE_LINEAGES_ADD = 'gossi.trixionary.skill.pre_lineages_add';

	/**
	 */
	const PRE_LINEAGES_REMOVE = 'gossi.trixionary.skill.pre_lineages_add';

	/**
	 */
	const PRE_LINEAGES_UPDATE = 'gossi.trixionary.skill.pre_lineages_update';

	/**
	 */
	const PRE_MULTIPLE_OF_UPDATE = 'gossi.trixionary.skill.pre_multiple_of_update';

	/**
	 */
	const PRE_MULTIPLES_ADD = 'gossi.trixionary.skill.pre_multiples_add';

	/**
	 */
	const PRE_MULTIPLES_REMOVE = 'gossi.trixionary.skill.pre_multiples_add';

	/**
	 */
	const PRE_MULTIPLES_UPDATE = 'gossi.trixionary.skill.pre_multiples_update';

	/**
	 */
	const PRE_OBJECT_UPDATE = 'gossi.trixionary.skill.pre_object_update';

	/**
	 */
	const PRE_PARTS_ADD = 'gossi.trixionary.skill.pre_parts_add';

	/**
	 */
	const PRE_PARTS_REMOVE = 'gossi.trixionary.skill.pre_parts_add';

	/**
	 */
	const PRE_PARTS_UPDATE = 'gossi.trixionary.skill.pre_parts_update';

	/**
	 */
	const PRE_PICTURES_ADD = 'gossi.trixionary.skill.pre_pictures_add';

	/**
	 */
	const PRE_PICTURES_REMOVE = 'gossi.trixionary.skill.pre_pictures_add';

	/**
	 */
	const PRE_PICTURES_UPDATE = 'gossi.trixionary.skill.pre_pictures_update';

	/**
	 */
	const PRE_REFERENCES_ADD = 'gossi.trixionary.skill.pre_references_add';

	/**
	 */
	const PRE_REFERENCES_REMOVE = 'gossi.trixionary.skill.pre_references_add';

	/**
	 */
	const PRE_REFERENCES_UPDATE = 'gossi.trixionary.skill.pre_references_update';

	/**
	 */
	const PRE_SAVE = 'gossi.trixionary.skill.pre_save';

	/**
	 */
	const PRE_SPORT_UPDATE = 'gossi.trixionary.skill.pre_sport_update';

	/**
	 */
	const PRE_START_POSITION_UPDATE = 'gossi.trixionary.skill.pre_start_position_update';

	/**
	 */
	const PRE_UPDATE = 'gossi.trixionary.skill.pre_update';

	/**
	 */
	const PRE_VARIATION_OF_UPDATE = 'gossi.trixionary.skill.pre_variation_of_update';

	/**
	 */
	const PRE_VARIATIONS_ADD = 'gossi.trixionary.skill.pre_variations_add';

	/**
	 */
	const PRE_VARIATIONS_REMOVE = 'gossi.trixionary.skill.pre_variations_add';

	/**
	 */
	const PRE_VARIATIONS_UPDATE = 'gossi.trixionary.skill.pre_variations_update';

	/**
	 */
	const PRE_VIDEOS_ADD = 'gossi.trixionary.skill.pre_videos_add';

	/**
	 */
	const PRE_VIDEOS_REMOVE = 'gossi.trixionary.skill.pre_videos_add';

	/**
	 */
	const PRE_VIDEOS_UPDATE = 'gossi.trixionary.skill.pre_videos_update';

	/**
	 */
	protected $skill;

	/**
	 * @param Skill $skill
	 */
	public function __construct(Skill $skill) {
		$this->skill = $skill;
	}

	/**
	 * @return Skill
	 */
	public function getSkill() {
		return $this->skill;
	}
}
