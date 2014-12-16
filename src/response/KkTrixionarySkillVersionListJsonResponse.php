<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\SkillVersion;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for List all kk_trixionary_skill_versions
 * 
 * @author gossi
 */
class KkTrixionarySkillVersionListJsonResponse extends AbstractKkTrixionarySkillVersionResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$out = [];

		// build model
		$out['kk_trixionary_skill_versions'] = [];
		foreach ($this->data as $kk_trixionary_skill_version) {
			$out['kk_trixionary_skill_versions'][] = $this->kk_trixionary_skill_versionToArray($kk_trixionary_skill_version);
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
