<?php
namespace gossi\trixionary\responder\json;

use keeko\framework\domain\payload\Success;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * JsonResponse for Delete Uploaded media
 *
 * @author gossi
 */
class UploadDeleteJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Success $payload
	 */
	public function success(Request $request, Success $payload) {
		return new JsonResponse($payload->get(), 204);
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\Success' => 'success'
		];
	}
}
