<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Skill;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all skills
 * 
 * @author gossi
 */
class SkillListJsonResponse extends AbstractSkillResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['skills'] = [];
		foreach ($this->data as $skill) {
			$out['skills'][] = $this->skillToArray($skill);
		}

		// meta
		$out['meta'] = [
			'total' => $this->data->getNbResults(),
			'first' => $this->data->getFirstPage(),
			'next' => $this->data->getNextPage(),
			'previous' => $this->data->getPreviousPage(),
			'last' => $this->data->getLastPage()
		];

		// return response
		return new JsonResponse($out);
	}
}
