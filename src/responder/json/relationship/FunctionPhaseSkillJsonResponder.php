<?php
namespace gossi\trixionary\responder\json\relationship;

use gossi\trixionary\model\FunctionPhase;
use keeko\framework\domain\payload\Found;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\domain\payload\NotUpdated;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Automatically generated JsonResponder for Reads the relationship of function_phase to skill
 * 
 * @author gossi
 */
class FunctionPhaseSkillJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param NotFound $payload
	 */
	public function notFound(Request $request, NotFound $payload) {
		throw new ResourceNotFoundException($payload->getMessage());
	}

	/**
	 * @param Request $request
	 * @param NotUpdated $payload
	 */
	public function notUpdated(Request $request, NotUpdated $payload) {
		return new JsonResponse(null, 204);
	}

	/**
	 * @param Request $request
	 * @param Found $payload
	 */
	public function read(Request $request, Found $payload) {
		$serializer = FunctionPhase::getSerializer();
		$relationship = $serializer->skill($payload->getModel());

		return new JsonResponse($relationship->toArray());
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\NotFound' => 'notFound',
			'keeko\framework\domain\payload\NotValid' => 'notValid',
			'keeko\framework\domain\payload\Updated' => 'updated',
			'keeko\framework\domain\payload\NotUpdated' => 'notUpdated'
		];
	}
}
