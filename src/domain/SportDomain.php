<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\SportDomainTrait;
use keeko\framework\foundation\AbstractDomain;
use gossi\trixionary\model\Sport;
use phootwork\lang\Text;
use Cocur\Slugify\Slugify;
use Imagine\Gd\Imagine;
use phootwork\file\Directory;
use phootwork\file\File;

/**
 */
class SportDomain extends AbstractDomain {

	use SportDomainTrait;

	protected function preSave(Sport $sport) {
		$slugifier = new Slugify();
		// set slug
		if (Text::create($sport->getSlug())->isEmpty()) {
			$sport->setSlug($slugifier->slugify($sport->getTitle()));
		}

		// set object slug
		if (Text::create($sport->getObjectSlug())->isEmpty() && !Text::create($sport->getObjectLabel())->isEmpty()) {
			$sport->setObjectSlug($slugifier->slugify($sport->getObjectLabel()));
		}

		// set skill slug
		if (Text::create($sport->getSkillSlug())->isEmpty()) {
			$sport->setSkillSlug($slugifier->slugify($sport->getSkillLabel()));
		}

		// set group slug
		if (Text::create($sport->getGroupSlug())->isEmpty()) {
			$sport->setGroupSlug($slugifier->slugify($sport->getGroupLabel()));
		}
	}

	/**
	 * @param Sport $sport
	 * @param array $data
	 */
	protected function postSave(Sport $sport, array $data) {
		// upload picture
		if (isset($data['meta']) && isset($data['meta']['filename']) && !empty($data['meta']['filename'])) {
			$module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');

		    // ensure directory
		    $dir = new Directory($module->getSportPath($sport));
		    if (!$dir->exists()) {
		    	$dir->make();
		    }

		    $destpath = $module->getSkillPreviewPath($sport);
		    $dest = new File($destpath);
		    if ($dest->exists()) {
		        $dest->delete();
		    }

		    $file = new File($module->getUploadPath()->append($data['meta']['filename']));
		    $imagine = new Imagine();
		    $image = $imagine->open($file->toPath()->toString());
		    $image->save($dest->toPath()->toString());
		    $file->delete();

		    $sport->setSkillPictureUrl($module->getSkillPreviewUrl($sport));
		    $sport->save();
		}

		// delete picture
		if (isset($data['meta']) && isset($data['meta']['skill_picture_delete']) && $data['meta']['skill_picture_delete'] == 1) {
			$module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
			$path = $module->getSkillPreviewPath($sport);
			$file = new File($path);
			$file->delete();
			$sport->setSkillPictureUrl(null);
			$sport->save();
		}
	}
}
