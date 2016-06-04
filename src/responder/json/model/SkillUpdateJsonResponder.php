<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\FunctionPhase;
use gossi\trixionary\model\Group;
use gossi\trixionary\model\Kstruktur;
use gossi\trixionary\model\Object;
use gossi\trixionary\model\Picture;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Reference;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use gossi\trixionary\model\Video;
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
 * Automatically generated JsonResponder for Updates a skill
 * 
 * @author gossi
 */
class SkillUpdateJsonResponder extends AbstractPayloadResponder {

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
		$serializer = Skill::getSerializer();
		$resource = new Resource($payload->getModel(), $serializer);
		$resource = $resource->with($params->getInclude(['sport', 'variations', 'variation-of', 'multiples', 'multiple-of', 'object', 'start-position', 'end-position', 'featured-picture', 'kstruktur-root', 'function-phase-root', 'descendents', 'parts', 'groups', 'pictures', 'videos', 'references', 'kstrukturs', 'function-phases']));
		$resource = $resource->fields($params->getFields([
			'skill' => Skill::getSerializer()->getFields(),
			'sport' => Sport::getSerializer()->getFields(),
			'variation' => Skill::getSerializer()->getFields(),
			'variation-of' => Skill::getSerializer()->getFields(),
			'multiple' => Skill::getSerializer()->getFields(),
			'multiple-of' => Skill::getSerializer()->getFields(),
			'object' => Object::getSerializer()->getFields(),
			'start-position' => Position::getSerializer()->getFields(),
			'end-position' => Position::getSerializer()->getFields(),
			'featured-picture' => Picture::getSerializer()->getFields(),
			'kstruktur-root' => Kstruktur::getSerializer()->getFields(),
			'function-phase-root' => FunctionPhase::getSerializer()->getFields(),
			'descendent' => Skill::getSerializer()->getFields(),
			'part' => Skill::getSerializer()->getFields(),
			'group' => Group::getSerializer()->getFields(),
			'picture' => Picture::getSerializer()->getFields(),
			'video' => Video::getSerializer()->getFields(),
			'reference' => Reference::getSerializer()->getFields(),
			'kstruktur' => Kstruktur::getSerializer()->getFields(),
			'function-phase' => FunctionPhase::getSerializer()->getFields()
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
