<?php
namespace gossi\trixionary\action\base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Video;
use gossi\trixionary\model\VideoQuery;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Base methods for Deletes a video
 * 
 * This code is automatically created
 * 
 * @author gossi
 */
trait VideoDeleteActionTrait {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// read
		$id = $this->getParam('id');
		$video = VideoQuery::create()->findOneById($id);

		// check existence
		if ($video === null) {
			throw new ResourceNotFoundException('video not found.');
		}

		// delete
		$video->delete();

		// set response and go
		$this->response->setData($video);
		return $this->response->run($request);
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultParams(OptionsResolverInterface $resolver) {
		$resolver->setRequired(['id']);
	}
}
