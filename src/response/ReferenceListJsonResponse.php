<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Reference;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all references
 * 
 * @author gossi
 */
class ReferenceListJsonResponse extends AbstractReferenceResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['references'] = [];
		foreach ($this->data as $reference) {
			$out['references'][] = $this->referenceToArray($reference);
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
