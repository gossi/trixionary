<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\PictureDomainTrait;
use gossi\trixionary\model\Picture;
use keeko\framework\foundation\AbstractDomain;
use phootwork\file\Directory;
use phootwork\file\File;
use Cocur\Slugify\Slugify;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use keeko\core\model\ActivityObject;

/**
 */
class PictureDomain extends AbstractDomain {

	use PictureDomainTrait;

	/**
	 */
	const THUMB_MAX_SIZE = 300;

	/**
	 * @param Picture $picture
	 */
	protected function postDelete(Picture $picture) {
		$module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
		$file = new File($picture->getUrl());
		$slugifier = new Slugify();
		$filename = sprintf('%s-%u.%s', $slugifier->slugify($picture->getAthlete()), $picture->getId(), $file->getExtension());
		$picturePath = $module->getPicturesPath($picture->getSkill());
		$image = new File($picturePath->append($filename));
		$image->delete();
		$thumb = new File($picturePath->append('thumbs')->append($filename));
		$thumb->delete();
	}

	/**
	 * @param Picture $picture
	 * @param array $data
	 */
	protected function postSave(Picture $picture, array $data) {
		if (isset($data['meta']) && isset($data['meta']['filename'])) {
		    $module = $this->getServiceContainer()->getModuleManager()->load('gossi/trixionary');
		    $file = new File($module->getUploadPath()->append($data['meta']['filename']));
		    $slugifier = new Slugify();
		    $filename = sprintf('%s-%u.%s', $slugifier->slugify($picture->getAthlete()), $picture->getId(), $file->getExtension());
		    $filepath = $module->getPicturesPath($picture->getSkill())->append($filename);
		    $file->move($filepath);
		    // create thumb folder
		    $thumbspath = $module->getPicturesPath($picture->getSkill())->append('thumbs');
		    $dir = new Directory($thumbspath);
		    if (!$dir->exists()) {
		        $dir->make();
		    }
		    // create thumb
		    $imagine = new Imagine();
		    $image = $imagine->open($filepath->toString());
		    $max = max($image->getSize()->getWidth(), $image->getSize()->getHeight());
		    $width = $image->getSize()->getWidth() / $max * self::THUMB_MAX_SIZE;
		    $height = $image->getSize()->getHeight() / $max * self::THUMB_MAX_SIZE;
		    $size = new Box($width, $height);
		    $thumbpath = $thumbspath->append($filename);
		    $image->thumbnail($size)->save($thumbpath->toString());
		    // save to picture
		    $picture->setUrl($module->getPicturesUrl($picture->getSkill()) . '/' . $filename);
		    $picture->setThumbUrl($module->getPicturesUrl($picture->getSkill()) . '/thumbs/' . $filename);
		    $picture->save();
		}

		// activity
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$user->newActivity([
			'verb' => $picture->isNew() ? ActivityObject::VERB_UPLOAD : ActivityObject::VERB_EDIT,
			'object' => $picture,
			'target' => $picture->getSkill()
		]);
	}

	/**
	 * @param Picture $picture
	 * @param array $data
	 */
	protected function preSave(Picture $picture, array $data) {
		// set uploader
		$user = $this->getServiceContainer()->getAuthManager()->getUser();
		$picture->setUploaderId($user->getId());
	}
}
