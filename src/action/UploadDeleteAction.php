<?php
namespace gossi\trixionary\action;

use keeko\framework\foundation\AbstractAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Upload media
 *
 * @author gossi
 */
class UploadDeleteAction extends AbstractAction {

	/**
	 * Automatically generated run method
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// uncomment the following to pass data to your response
		$file = $this->params['file'];
		$fileName = $this->getModule()->getUploadPath() . '/' . $file;

		if (!file_exists($fileName)) {
			throw new ResourceNotFoundException(sprintf('File %s does not exist', $file));
		}

		$success = unlink($fileName);

		$this->response->setData(['files' => [[$file => $success]]]);
		return $this->response->run($request);
	}

	protected function setDefaultParams(OptionsResolverInterface $resolver) {
		$resolver->setRequired(['file']);
	}
}
