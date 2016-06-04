<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\Skill;
use gossi\trixionary\model\SkillVersion;
use keeko\framework\domain\payload\NotFound;
use keeko\framework\domain\payload\NotUpdated;
use keeko\framework\domain\payload\NotValid;
use keeko\framework\domain\payload\Updated;
use keeko\framework\exceptions\ValidationException;
use keeko\framework\foundation\AbstractPayloadResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Parameters;
use Tobscure\JsonApi\Resource;

/**
 * Automatically generated JsonResponder for Updates a skill_version
 * 
 * @author gossi
 */
class SkillVersionUpdateJsonResponder extends AbstractPayloadResponder {

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
	 * @param NotValid $payload
	 */
	public function notValid(Request $request, NotValid $payload) {
		throw new ValidationException($payload->getViolations());
	}

	/**
	 * @param Request $request
	 * @param Updated $payload
	 */
	public function updated(Request $request, Updated $payload) {
		$params = new Parameters($request->query->all());
		$serializer = SkillVersion::getSerializer();
		$resource = new Resource($payload->getModel(), $serializer);
		$resource = $resource->with($params->getInclude(['skill']));
		$resource = $resource->fields($params->getFields([
			'skill-version' => SkillVersion::getSerializer()->getFields(),
			'skill' => Skill::getSerializer()->getFields()
		]));
		$document = new Document($resource);

		return new JsonResponse($document->toArray(), 200);
	}

	/**
	 */
	protected function getPayloadMethods() {
		return [
			'keeko\framework\domain\payload\NotValid' => 'notValid',
			'keeko\framework\domain\payload\NotFound' => 'notFound',
			'keeko\framework\domain\payload\Updated' => 'updated',
			'keeko\framework\domain\payload\NotUpdated' => 'notUpdated'
		];
	}
}
