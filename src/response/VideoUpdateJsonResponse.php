<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Video;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Updates a video
 * 
 * @author gossi
 */
class VideoUpdateJsonResponse extends AbstractVideoResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->videoToArray($this->data));
	}
}
