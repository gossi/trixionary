<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\Position;
use keeko\framework\domain\payload\Created;
use keeko\framework\domain\payload\NotValid;
use keeko\framework\exceptions\ValidationException;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Resource;

/**
 * Automatically generated JsonResponder for Creates a position
 * 
 * @author Thomas Gossmann
 */
class PositionCreateJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Created $payload
	 */
	public function created(Request $request, Created $payload) {
		$serializer = Position::getSerializer();
		$resource = new Resource($payload->getModel(), $serializer);
		$document = new Document($resource);

		return new JsonResponse($document->toArray(), 201, ['Location' => $resource->getLinks()['self']]);
	}

	/**
	 * @param Request $request
	 * @param NotValid $payload
	 */
	public function notValid(Request $request, NotValid $payload) {
		throw new ValidationException($payload->getViolations());
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\NotValid' => 'notValid',
			'keeko\framework\domain\payload\Created' => 'created'
		];
	}
}
