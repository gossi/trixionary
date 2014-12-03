<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Skill;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Reads a skill
 * 
 * @author gossi
 */
class SkillReadJsonResponse extends AbstractSkillResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->skillToArray($this->data));
	}
}
