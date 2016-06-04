<?php
namespace gossi\trixionary\responder;

use keeko\framework\foundation\AbstractResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * JsonResponse for Delete Uploaded media
 *
 * @author gossi
 */
class UploadDeleteJsonResponse extends AbstractResponder {

	/**
	 * Automatically generated method, will be overridden
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		return new JsonResponse($this->data);
	}
}
