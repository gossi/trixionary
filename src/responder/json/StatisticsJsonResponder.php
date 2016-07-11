<?php
namespace gossi\trixionary\responder\json;

use keeko\framework\domain\payload\Blank;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Automatically generated JsonResponder for Statistics
 *
 * @author Thomas Gossmann
 */
class StatisticsJsonResponder extends AbstractPayloadResponder {

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\Blank' => 'blank'
		];
	}

	protected function blank(Request $request, Blank $payload) {
		return new JsonResponse($payload->get());
	}
}
