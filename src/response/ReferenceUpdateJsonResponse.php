<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Reference;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Updates a reference
 * 
 * @author gossi
 */
class ReferenceUpdateJsonResponse extends AbstractReferenceResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->referenceToArray($this->data));
	}
}
