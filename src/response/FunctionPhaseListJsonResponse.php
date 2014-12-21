<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\FunctionPhase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all function_phases
 * 
 * @author gossi
 */
class FunctionPhaseListJsonResponse extends AbstractFunctionPhaseResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['function_phases'] = [];
		foreach ($this->data as $function_phase) {
			$out['function_phases'][] = $this->function_phaseToArray($function_phase);
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
