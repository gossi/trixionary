<?php
namespace gossi\trixionary\action;

use gossi\trixionary\model\SportQuery;
use keeko\framework\domain\payload\Blank;
use keeko\framework\foundation\AbstractAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use gossi\trixionary\model\PictureQuery;
use gossi\trixionary\model\VideoQuery;
use gossi\trixionary\model\ReferenceQuery;

/**
 * Statistics
 *
 * This code is automatically created. Modifications will probably be overwritten.
 *
 * @author Thomas Gossmann
 */
class SportStatisticsAction extends AbstractAction {

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureParams(OptionsResolver $resolver) {
		$resolver->setRequired(['id']);
	}

	/**
	 * Automatically generated run method
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$id = $this->getParam('id');
		$sport = SportQuery::create()
			->joinGroup()
			->joinSkill()
			->findOneById($id);

		$pictures = PictureQuery::create()
			->useSkillQuery()
				->filterBySportId($id)
			->endUse()
			->count();

		$videos = VideoQuery::create()
			->useSkillQuery()
				->filterBySportId($id)
			->endUse()
			->count();

		$references = ReferenceQuery::create()
			->useSkillReferenceQuery()
				->useSkillQuery()
					->filterBySportId($id)
				->endUse()
			->endUse()
			->count();

		$statistics = [
			'skills' => $sport->countSkills(),
			'groups' => $sport->countGroups(),
			'pictures' => $pictures,
			'videos' => $videos,
			'references' => $references
		];

		return $this->responder->run($request, new Blank($statistics));
	}
}
