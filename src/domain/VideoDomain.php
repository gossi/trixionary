<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\VideoDomainTrait;
use keeko\framework\foundation\AbstractDomain;
use gossi\trixionary\model\Video;
use phootwork\file\File;

/**
 */
class VideoDomain extends AbstractDomain {

	use VideoDomainTrait;

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
	}

	protected function preSave(Video $video, array $data) {
		// set uploader
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$video->setUploaderId($user->getId());
	}
}
