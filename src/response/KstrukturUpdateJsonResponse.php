<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Kstruktur;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Updates a kstruktur
 * 
 * @author gossi
 */
class KstrukturUpdateJsonResponse extends AbstractKstrukturResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->kstrukturToArray($this->data));
	}
}
