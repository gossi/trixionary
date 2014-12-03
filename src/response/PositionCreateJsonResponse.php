<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Position;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Creates a position
 * 
 * @author gossi
 */
class PositionCreateJsonResponse extends AbstractPositionResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->positionToArray($this->data), 201);
	}
}
