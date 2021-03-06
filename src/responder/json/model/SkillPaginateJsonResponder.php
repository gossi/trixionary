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
use keeko\framework\foundation\AbstractPayloadResponder;
use keeko\framework\utils\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Document;

/**
 * Automatically generated JsonResponder for Paginates skills
 * 
 * @author Thomas Gossmann
 */
class SkillPaginateJsonResponder extends AbstractPayloadResponder {

	/**
	 * @param Request $request
	 * @param Found $payload
	 */
	public function found(Request $request, Found $payload) {
		$params = new Parameters($request->query->all());
		$data = $payload->getModel();
		$serializer = Skill::getSerializer();
		$resource = new Collection($data, $serializer);
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
