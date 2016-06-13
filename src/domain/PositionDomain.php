<?php
namespace gossi\trixionary\domain;

use gossi\trixionary\domain\base\PositionDomainTrait;
use gossi\trixionary\model\Position;
use keeko\framework\foundation\AbstractDomain;
use phootwork\lang\Text;
use Cocur\Slugify\Slugify;

/**
 */
class PositionDomain extends AbstractDomain {

	use PositionDomainTrait;

	/**
	 * @param Position $model
	 */
	protected function preCreate(Position $model) {
		if (Text::create($model->getSlug())->isEmpty()) {
		    $title = $model->getTitle();
		    $slugifier = new Slugify();
		    $model->setSlug($slugifier->slugify($title));
		}
	}
}
