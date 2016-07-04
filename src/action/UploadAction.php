<?php
namespace gossi\trixionary\action;

use Cocur\Slugify\Slugify;
use keeko\framework\domain\payload\Failed;
use keeko\framework\domain\payload\Success;
use keeko\framework\foundation\AbstractAction;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
		$file = $request->files->get('file');

		try {
			// validate: upload progress
			if (!$file->isValid()) {
				throw new FileException($file->getErrorMessage());
			}

			// validate: mime type
			$mimeTypes = ['image/png', 'image/jpeg', 'image/jpg', 'video/mp4', 'video/quicktime'];
			if (!in_array($file->getClientMimeType(), $mimeTypes)) {
				throw new FileException('No matching mime type');
			}

			// validate: extension
			$exts = ['png', 'jpg', 'jpeg', 'mp4', 'mov'];
			if (!in_array($file->getClientOriginalExtension(), $exts)) {
				throw new FileException('No matching extension');
			}

			// move uploaded file
			$slugifier = new Slugify();
			$fileName = $file->getClientOriginalName();
			$fileName = str_replace('.' . $file->getClientOriginalExtension(), '', $fileName);
			$fileName = $slugifier->slugify($fileName) . '.' . $file->getClientOriginalExtension();
			$file->move($this->getModule()->getUploadPath()->toString(), $fileName);
			$payload = new Success([
				'filename' => $fileName,
				'url' => $this->getModule()->getUploadUrl() . '/' . urlencode($fileName)
			]);
		} catch (FileException $e) {
			$payload = new Failed(['error' => $e->getMessage()]);
		}

		return $this->responder->run($request, $payload);
	}
}
