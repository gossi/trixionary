<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Sport;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Reads a sport
 * 
 * @author gossi
 */
class SportReadJsonResponse extends AbstractSportResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->sportToArray($this->data));
	}
}
