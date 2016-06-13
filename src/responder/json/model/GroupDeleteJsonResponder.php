<?php
namespace gossi\trixionary\responder\json\model;

use keeko\framework\domain\payload\Deleted;
use keeko\framework\domain\payload\NotDeleted;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Automatically generated JsonResponder for Deletes a group
 * 
 * @author Thomas Gossmann
 */
class GroupDeleteJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Deleted $payload
	 */
	public function deleted(Request $request, Deleted $payload) {
		return new JsonResponse(null, 204);
	}

	/**
	 * @param Request $request
	 * @param NotDeleted $payload
	 */
	public function notDeleted(Request $request, NotDeleted $payload) {
		return new \Exception($payload->getMessage());
	}

	/**
	 * @param Request $request
	 * @param NotFound $payload
	 */
	public function notFound(Request $request, NotFound $payload) {
		throw new ResourceNotFoundException($payload->getMessage());
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\NotFound' => 'notFound',
			'keeko\framework\domain\payload\Deleted' => 'deleted',
			'keeko\framework\domain\payload\NotDeleted' => 'notDeleted'
		];
	}
}
