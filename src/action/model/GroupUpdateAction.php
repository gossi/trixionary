<?php
namespace gossi\trixionary\action\model;

use gossi\trixionary\domain\GroupDomain;
use keeko\framework\foundation\AbstractAction;
use phootwork\json\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tobscure\JsonApi\Exception\InvalidParameterException;

/**
 * Updates a group
 * 
 * This code is automatically created. Modifications will probably be overwritten.
 * 
 * @author Thomas Gossmann
 */
class GroupUpdateAction extends AbstractAction {

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
		$id = $this->getParam('id');
		$body = Json::decode($request->getContent());
		if (!isset($body['data'])) {
			throw new InvalidParameterException();
		}
		$data = $body['data'];
		$domain = new GroupDomain($this->getServiceContainer());
		$payload = $domain->update($id, $data);
		return $this->responder->run($request, $payload);
	}
}
