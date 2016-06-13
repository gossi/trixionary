<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\SkillDomainTrait;
use gossi\trixionary\model\Skill;
use keeko\framework\foundation\AbstractDomain;
use phootwork\lang\Text;
use Cocur\Slugify\Slugify;

/**
 */
class SkillDomain extends AbstractDomain {

	use SkillDomainTrait;

	/**
	 * @param Skill $model
	 */
	protected function preSave(Skill $model) {
		if (Text::create($model->getSlug())->isEmpty()) {
		    $name = str_replace('°', '', $model->getName());
		    $slugifier = new Slugify();
		    $model->setSlug($slugifier->slugify($name));
		}
	}
}
