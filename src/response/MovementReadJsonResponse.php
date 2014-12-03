<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Movement;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Reads a movement
 * 
 * @author gossi
 */
class MovementReadJsonResponse extends AbstractMovementResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->movementToArray($this->data));
	}
}
