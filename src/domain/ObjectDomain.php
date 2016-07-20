<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\ObjectDomainTrait;
use keeko\framework\foundation\AbstractDomain;
use gossi\trixionary\model\Object;
use Cocur\Slugify\Slugify;
use phootwork\lang\Text;

/**
 */
class ObjectDomain extends AbstractDomain {

	use ObjectDomainTrait;

	protected function preSave(Object $object) {
		// set slug
		if (Text::create($object->getSlug())->isEmpty()) {
			$slugifier = new Slugify();
			$object->setSlug($slugifier->slugify($object->getTitle()));
		}
	}
}
