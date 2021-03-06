<?php
namespace gossi\trixionary\responder\json\model;

use gossi\trixionary\model\FunctionPhase;
use gossi\trixionary\model\Group;
use gossi\trixionary\model\Kstruktur;
use gossi\trixionary\model\Lineage;
use gossi\trixionary\model\Object;
use gossi\trixionary\model\Picture;
use gossi\trixionary\model\Position;
use gossi\trixionary\model\Reference;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use gossi\trixionary\model\Video;
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
 * Automatically generated JsonResponder for Reads a skill
 * 
 * @author Thomas Gossmann
 */
class SkillReadJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Found $payload
	 */
	public function found(Request $request, Found $payload) {
		$params = new Parameters($request->query->all());
		$serializer = Skill::getSerializer();
		$resource = new Resource($payload->getModel(), $serializer);
		$resource = $resource->with($params->getInclude(['sport', 'variations', 'variation-of', 'multiples', 'multiple-of', 'object', 'start-position', 'end-position', 'featured-picture', 'featured-video', 'featured-tutorial', 'kstruktur-root', 'function-phase-root', 'children', 'parents', 'parts', 'composites', 'groups', 'references', 'lineages', 'pictures', 'videos', 'kstrukturs', 'function-phases', 'sport.skills']));
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
			'featured-video' => Video::getSerializer()->getFields(),
			'featured-tutorial' => Video::getSerializer()->getFields(),
			'kstruktur-root' => Kstruktur::getSerializer()->getFields(),
			'function-phase-root' => FunctionPhase::getSerializer()->getFields(),
			'child' => Skill::getSerializer()->getFields(),
			'parent' => Skill::getSerializer()->getFields(),
			'part' => Skill::getSerializer()->getFields(),
			'composite' => Skill::getSerializer()->getFields(),
			'group' => Group::getSerializer()->getFields(),
			'reference' => Reference::getSerializer()->getFields(),
			'lineage' => Lineage::getSerializer()->getFields(),
			'picture' => Picture::getSerializer()->getFields(),
			'video' => Video::getSerializer()->getFields(),
			'kstruktur' => Kstruktur::getSerializer()->getFields(),
			'function-phase' => FunctionPhase::getSerializer()->getFields()
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
