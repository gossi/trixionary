<?php
namespace gossi\trixionary\action\relationship;

use gossi\trixionary\domain\SkillDomain;
use keeko\framework\foundation\AbstractAction;
use phootwork\json\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tobscure\JsonApi\Exception\InvalidParameterException;

/**
 * Updates the relationship of skill to video
 * 
 * This code is automatically created. Modifications will probably be overwritten.
 * 
 * @author Thomas Gossmann
 */
class SkillVideoUpdateAction extends AbstractAction {

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureParams(OptionsResolver $resolver) {
		$resolver->setRequired(['id']);
	}

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$body = Json::decode($request->getContent());
		if (!isset($body['data'])) {
			throw new InvalidParameterException();
		}
		$data = $body['data'];
		$id = $this->getParam('id');
		$domain = new SkillDomain($this->getServiceContainer());
		$payload = $domain->updateVideo($id, $data);
		return $this->responder->run($request, $payload);
	}
}
