<?php
namespace gossi\trixionary\action\model;

use gossi\trixionary\domain\PositionDomain;
use keeko\framework\foundation\AbstractAction;
use phootwork\json\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tobscure\JsonApi\Exception\InvalidParameterException;

/**
 * Creates a position
 * 
 * This code is automatically created. Modifications will probably be overwritten.
 * 
 * @author gossi
 */
class PositionCreateAction extends AbstractAction {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$body = Json::decode($request->getContent());
		if (!isset($body['data'])) {
			throw new InvalidParameterException();
		}
		$data = $body['data'];
		$domain = new PositionDomain($this->getServiceContainer());
		$payload = $domain->create($data);
		return $this->responder->run($request, $payload);
	}
}
