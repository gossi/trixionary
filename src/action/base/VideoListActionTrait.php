<?php
namespace gossi\trixionary\action\base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Video;
use gossi\trixionary\model\VideoQuery;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Base methods for List all videos
 * 
 * This code is automatically created
 * 
 * @author gossi
 */
trait VideoListActionTrait {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// read
		$page = $this->getParam('page');
		$perPage = $this->getParam('per_page');
		$video = VideoQuery::create()->paginate($page, $perPage);

		// set response and go
		$this->response->setData($video);
		return $this->response->run($request);
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultParams(OptionsResolverInterface $resolver) {
		$resolver->setDefaults([
			'page' => 1,
			'per_page' => 50,
		]);
	}
}
