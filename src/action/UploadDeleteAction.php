<?php
namespace gossi\trixionary\action;

use keeko\framework\domain\payload\Success;
use keeko\framework\foundation\AbstractAction;
use phootwork\file\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Upload media
 *
 * @author gossi
 */
class UploadDeleteAction extends AbstractAction {

	protected function configureParams(OptionsResolver $resolver) {
		$resolver->setRequired(['filename']);
	}

	/**
	 * Automatically generated run method
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$fileName = $this->getParam('filename');
		$file = new File($this->getModule()->getUploadPath()->append($fileName));

		if (!$file->exists()) {
			throw new ResourceNotFoundException(sprintf('File %s does not exist', $fileName));
		}

		$file->delete();
		return $this->responder->run($request, new Success());
	}

}
