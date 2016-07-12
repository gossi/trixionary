<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\Position;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use keeko\framework\domain\payload\Found;
use keeko\framework\foundation\AbstractPayloadResponder;
use keeko\framework\utils\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Document;

/**
 * Automatically generated JsonResponder for Paginates positions
 * 
 * @author Thomas Gossmann
 */
class PositionPaginateJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Found $payload
	 */
	public function found(Request $request, Found $payload) {
		$params = new Parameters($request->query->all());
		$data = $payload->getModel();
		$serializer = Position::getSerializer();
		$resource = new Collection($data, $serializer);
		$resource = $resource->with($params->getInclude(['sport', 'skill']));
		$resource = $resource->fields($params->getFields([
			'position' => Position::getSerializer()->getFields(),
			'sport' => Sport::getSerializer()->getFields(),
			'skill' => Skill::getSerializer()->getFields()
		]));
		$document = new Document($resource);

		// meta
		if ($params->getPage('size') != -1) {
		    $document->setMeta([
		    	'total' => $data->getNbResults(),
		    	'first' => '%apiurl%/' . $serializer->getType(null) . '?' . $params->toQueryString(['page' => ['number' => $data->getFirstPage()]]),
		    	'next' => '%apiurl%/' . $serializer->getType(null) . '?' . $params->toQueryString(['page' => ['number' => $data->getNextPage()]]),
		    	'previous' => '%apiurl%/' . $serializer->getType(null) . '?' . $params->toQueryString(['page' => ['number' => $data->getPreviousPage()]]),
		    	'last' => '%apiurl%/' . $serializer->getType(null) . '?' . $params->toQueryString(['page' => ['number' => $data->getLastPage()]])
		    ]);
		}

		// return response
		return new JsonResponse($document->toArray());
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\Found' => 'found'
		];
	}
}
