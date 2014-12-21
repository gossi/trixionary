<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\FunctionPhase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Creates a function_phase
 * 
 * @author gossi
 */
class FunctionPhaseCreateJsonResponse extends AbstractFunctionPhaseResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->function_phaseToArray($this->data), 201);
	}
}
