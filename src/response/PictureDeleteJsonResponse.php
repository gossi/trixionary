<?php
namespace gossi\trixionary\response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Picture;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JsonResponse for Deletes a picture
 * 
 * @author gossi
 */
class PictureDeleteJsonResponse extends AbstractPictureResponse {

	/**
	 * Automatically generated method, will be overridden
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// return response
		return new JsonResponse($this->pictureToArray($this->data));
	}
}
