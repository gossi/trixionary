<?php
namespace gossi\trixionary\action;

use keeko\framework\foundation\AbstractAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Embed\Embed;
use keeko\framework\domain\payload\Found;

/**
 * oEmbed Fetcher
 *
 * This code is automatically created. Modifications will probably be overwritten.
 *
 * @author Thomas Gossmann
 */
class OembedFetchAction extends AbstractAction {

	protected function configureParams(OptionsResolver $resolver) {
		$resolver->setRequired('url');
	}

	/**
	 * Automatically generated run method
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$info = Embed::create($request->query->get('url'));

		return $this->responder->run($request, new Found(['info' => $info]));
	}
}
