<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\SkillVersion;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Deletes a kk_trixionary_skill_version
 * 
 * @author gossi
 */
class KkTrixionarySkillVersionDeleteJsonResponse extends AbstractKkTrixionarySkillVersionResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->kk_trixionary_skill_versionToArray($this->data));
	}
}
