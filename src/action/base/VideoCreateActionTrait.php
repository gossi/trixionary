<?php
namespace gossi\trixionary\action\base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gossi\trixionary\model\Video;
use keeko\core\exceptions\ValidationException;
use keeko\core\utils\HydrateUtils;

/**
 * Base methods for Creates a video
 * 
 * This code is automatically created
 * 
 * @author gossi
 */
trait VideoCreateActionTrait {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		$data = json_decode($request->getContent(), true);

		// hydrate
		$video = HydrateUtils::hydrate($data, new Video(), ['id', 'title', 'description', 'is_tutorial', 'movender', 'movender_id', 'uploader_id', 'skill_id']);

		// validate
		if (!$video->validate()) {
			throw new ValidationException($video->getValidationFailures());
		} else {
			$video->save();
			$this->response->setData($video);
			return $this->response->run($request);
		}
	}
}
