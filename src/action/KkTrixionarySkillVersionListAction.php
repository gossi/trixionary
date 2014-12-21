<?php
namespace gossi\trixionary\action;

use keeko\core\action\AbstractAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * List all kk_trixionary_skill_versions
 * 
 * @author gossi
 */
class KkTrixionarySkillVersionListAction extends AbstractAction {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// uncomment the following to pass data to your response
		// $this->response->setData($data);
		return $this->response->run($request);
	}
}
