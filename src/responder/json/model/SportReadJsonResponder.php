<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\Group;
use gossi\trixionary\model\Object;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use keeko\framework\domain\payload\Found;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Parameters;
use Tobscure\JsonApi\Resource;

/**
 * Automatically generated JsonResponder for Reads a sport
 * 
 * @author Thomas Gossmann
 */
class SportReadJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Found $payload
	 */
	public function found(Request $request, Found $payload) {
		$params = new Parameters($request->query->all());
		$serializer = Sport::getSerializer();
		$resource = new Resource($payload->getModel(), $serializer);
		$resource = $resource->with($params->getInclude(['objects', 'positions', 'skills', 'groups', 'skills.groups', 'skills.objects', 'skills.start-position', 'skills.end-position', 'skills.variationOf', 'skills.parents', 'skills.lineages', 'skills.lineages.ancestor', 'skills.lineages.skill', 'skills.featured-picture']));
		$resource = $resource->fields($params->getFields([
			'sport' => Sport::getSerializer()->getFields(),
			'object' => Object::getSerializer()->getFields(),
			'position' => Position::getSerializer()->getFields(),
			'skill' => Skill::getSerializer()->getFields(),
			'group' => Group::getSerializer()->getFields()
		]));
		$document = new Document($resource);

		return new JsonResponse($document->toArray(), 200);
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
			'keeko\framework\domain\payload\Found' => 'found',
			'keeko\framework\domain\payload\NotFound' => 'notFound'
		];
	}
}
