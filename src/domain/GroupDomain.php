<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\GroupDomainTrait;
use gossi\trixionary\model\Group;
use keeko\framework\foundation\AbstractDomain;
use phootwork\lang\Text;
use Cocur\Slugify\Slugify;

/**
 */
class GroupDomain extends AbstractDomain {

	use GroupDomainTrait;

	/**
	 * @param Group $model
	 */
	protected function preCreate(Group $model) {
		if (Text::create($model->getSlug())->isEmpty()) {
		    $title = $model->getTitle();
		    $slugifier = new Slugify();
		    $model->setSlug($slugifier->slugify($title));
		}
	}
}
