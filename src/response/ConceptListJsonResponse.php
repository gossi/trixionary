<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Concept;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all concepts
 * 
 * @author gossi
 */
class ConceptListJsonResponse extends AbstractConceptResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['concepts'] = [];
		foreach ($this->data as $concept) {
			$out['concepts'][] = $this->conceptToArray($concept);
		}

		// meta
		$out['meta'] = [
			'total' => $this->data->getNbResults(),
			'first' => $this->data->getFirstPage(),
			'next' => $this->data->getNextPage(),
			'previous' => $this->data->getPreviousPage(),
			'last' => $this->data->getLastPage()
		];

		// return response
		return new JsonResponse($out);
	}
}
