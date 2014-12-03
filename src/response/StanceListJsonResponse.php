<?php
namespace gossi\trixionary\response;

use keeko\core\action\AbstractResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * JsonResponse for List all stances
 * 
 * @author gossi
 */
class StanceListJsonResponse extends AbstractResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		return new JsonResponse();
	}
}
