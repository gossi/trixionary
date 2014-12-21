<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Kstruktur;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all kstrukturs
 * 
 * @author gossi
 */
class KstrukturListJsonResponse extends AbstractKstrukturResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['kstrukturs'] = [];
		foreach ($this->data as $kstruktur) {
			$out['kstrukturs'][] = $this->kstrukturToArray($kstruktur);
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
