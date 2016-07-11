<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\VideoDomainTrait;
use gossi\trixionary\model\Video;
use keeko\core\model\Activity;
use keeko\framework\foundation\AbstractDomain;
use phootwork\file\File;

/**
 */
class VideoDomain extends AbstractDomain {

	use VideoDomainTrait;

	/**
	 */
	private $isNew;

	/**
	 * @param Video $video
	 * @param array $data
	 */
	protected function postSave(Video $video, array $data) {
		if (isset($data['meta']) && isset($data['meta']['filename']) && !empty($data['meta']['filename'])) {
		    $module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
		    $file = new File($module->getUploadPath()->append($data['meta']['filename']));
		    $filename = $video->getFilename();
		    $filepath = $module->getVideosPath($video->getSkill())->append($filename);
		    $file->move($filepath);
		    $video->setUrl($module->getVideosUrl($video->getSkill()) . '/' . $filename);
		    $video->save();
		}
		if ($video->getReference()) {
		    $video->getReference()->addSkill($video->getSkill());
		    $video->save();
		}
		// activity
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$user->newActivity(array('verb' => $this->isNew ? Activity::VERB_UPLOAD : Activity::VERB_EDIT, 'object' => $video, 'target' => $video->getSkill()));
	}

	/**
	 * @param Video $video
	 * @param array $data
	 */
	protected function preSave(Video $video, array $data) {
		// set uploader
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$video->setUploaderId($user->getId());
		$this->isNew = $video->isNew();
	}
}
