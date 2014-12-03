<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Concept;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Reads a concept
 * 
 * @author gossi
 */
class ConceptReadJsonResponse extends AbstractConceptResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->conceptToArray($this->data));
	}
}
