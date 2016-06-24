<?php
namespace gossi\trixionary\responder\json;

use keeko\framework\domain\payload\Failed;
use keeko\framework\domain\payload\Success;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * JsonResponder for Upload media
 *
 * @author gossi
 */
class UploadJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Success $payload
	 */
	public function success(Request $request, Success $payload) {
		return new JsonResponse($payload->get());
	}

	/**
	 * @param Request $request
	 * @param Failed $payload
	 */
	public function failed(Request $request, Failed $payload) {
		throw new \Exception($payload->get('error'));
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\Failed' => 'failed',
			'keeko\framework\domain\payload\Success' => 'success'
		];
	}
}
