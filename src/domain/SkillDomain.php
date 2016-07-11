<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\calculation\Calculator;
use gossi\trixionary\domain\base\SkillDomainTrait;
use gossi\trixionary\model\LineageQuery;
use gossi\trixionary\model\SkillQuery;
use gossi\trixionary\model\Skill;
use keeko\core\model\Activity;
use keeko\framework\foundation\AbstractDomain;
use phootwork\file\File;
use phootwork\lang\Text;
use Cocur\Slugify\Slugify;
use phootwork\file\Directory;

/**
 */
class SkillDomain extends AbstractDomain {

	use SkillDomainTrait;

	/**
	 */
	private $isNew;

	/**
	 * @param Skill $skill
	 * @param mixed $data
	 */
	protected function postSave(Skill $skill, $data) {
		SkillQuery::disableVersioning();
		// calculate
		$calculator = new Calculator();
		$calculator->calculate($skill);
		$calculator->getModifiedGenerationSkills()->each(function (Skill $skill) {
		    LineageQuery::create()->filterBySkillId($skill->getId())->delete();
		});
		$calculator->getModifiedSkills()->each(function (Skill $skill) {
		    $skill->save();
		});
		// set sequence picture
		if (isset($data['meta']) && isset($data['meta']['filename'])) {
		    $module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
		    $destpath = $module->getSequencePath($skill);
		    $dest = new File($destpath);
		    if ($dest->exists()) {
		        $dest->delete();
		    }
		    $file = new File($module->getUploadPath()->append($data['meta']['filename']));
		    $file->move($destpath);
		    $skill->setSequencePictureUrl($module->getSequenceUrl($skill));
		    $skill->save();
		}
		SkillQuery::enableVersioning();
		// activity
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$user->newActivity(array('verb' => $this->isNew ? Activity::VERB_CREATE : Activity::VERB_AUTHOR, 'object' => $skill, 'target' => $skill->getSport()));
	}

	/**
	 * @param Skill $skill
	 */
	protected function preCreate(Skill $skill) {
		$skill->setVersionComment('Created');
	}

	/**
	 * @param Skill $skill
	 * @param mixed $data
	 */
	protected function preSave(Skill $skill) {
		// set slug
		if (Text::create($skill->getSlug())->isEmpty()) {
		    $name = str_replace('°', '', $skill->getName());
		    $slugifier = new Slugify();
		    $skill->setSlug($slugifier->slugify($name));
		}
		$this->isNew = $skill->isNew();
	}

	protected function postDelete(Skill $skill) {
		// delete folder
		$module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
		$dir = new Directory($module->getSkillPath($skill));
		$dir->delete();
	}
}
