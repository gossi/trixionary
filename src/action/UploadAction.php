<?php
namespace gossi\trixionary\action;

use keeko\core\action\AbstractAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Generator\Behavior\Sluggable\SluggableBehavior;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Upload media
 * 
 * @author gossi
 */
class UploadAction extends AbstractAction {

	/**
	 * Automatically generated run method
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function run(Request $request) {
		// uncomment the following to pass data to your response
		$error = null;
		$file = $request->files->get('file');
		$fileName = $file->getClientOriginalName();
		if ($file->isValid()) {
			try {
				// user validations
				$mimeTypes = ['image/png', 'image/jpeg', 'image/jpg', 'video/mpeg', 'video/quicktime'];
				$mimeTypesMatch = false;
				foreach ($mimeTypes as $mimeType) {
					if ($file->getClientMimeType() == $mimeType) {
						$mimeTypesMatch = true;
					}
				}
				
				if (!$mimeTypesMatch) {
					throw new FileException('No matching mime type');
				}
				
				$exts = ['png', 'jpg', 'mov', 'mp4'];
				$extMatch = false;
				foreach ($exts as $ext) {
					if ($file->getClientOriginalExtension() == $ext) {
						$extMatch = true;
					}
				}
				
				if (!$extMatch) {
					throw new FileException('No matching extension');
				}
			
				$slugifier = new Slugify();
				$fileName = str_replace('.' . $file->getClientOriginalExtension(), '', $fileName);
				$fileName = $slugifier->slugify($fileName) . '.' . $file->getClientOriginalExtension();
				$file->move($this->getModule()->getUploadPath(), $fileName);
			} catch (FileException $e) {
				$error = $e->getMessage();
			}
		} else {
			$error = $file->getErrorMessage();
		}
		$json = [
			'name' => $fileName,
			'size' => $file->getClientSize()
		];

		if ($error !== null) {
			$json['error'] = $error;
		} else {
			$json['url'] = $this->getModule()->getUploadUrl() . '/' . urlencode($fileName);
			$json['deleteUrl'] = $this->getServiceContainer()->getPreferenceLoader()->getSystemPreferences()->getApiUrl() . 'gossi.trixionary/upload/' . $fileName;
			$json['deleteType'] = 'DELETE';
		}

		$this->response->setData(['files' => [$json]]);
		return $this->response->run($request);
	}
}
