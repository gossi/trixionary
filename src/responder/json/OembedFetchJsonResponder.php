<?php
namespace gossi\trixionary\responder\json;

use keeko\framework\domain\payload\PayloadInterface;
use keeko\framework\foundation\AbstractResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Automatically generated JsonResponder for oEmbed Fetcher
 *
 * @author Thomas Gossmann
 */
class OembedFetchJsonResponder extends AbstractResponder {

	/**
	 * Automatically generated run method
	 *
	 * @param Request $request
	 * @param PayloadInterface $payload
	 * @return JsonResponse
	 */
	public function run(Request $request, PayloadInterface $payload = null) {
		$info = $payload->get('info');

		$playerUrl = null;
		$twittercards = $info->getProvider('twittercards');
		if ($twittercards) {
			$playerUrl = $twittercards->bag->get('player');
		}

		if (empty($playerUrl)) {
			$matches = [];
			preg_match('/src="([^"]+)"/', $info->code, $matches);
			$playerUrl = $matches[1];
		}

		return new JsonResponse([
			'title' => $info->title,
			'description' => $info->description,
			'url' => $info->url,
			'type' => $info->type,
			'tags' => $info->tags,
			'images' => $info->images,
			'image' => $info->image,
			'image-width' => $info->imageWidth,
			'image-height' => $info->imageHeight,
			'code' => $info->code,
			'player-url' => $playerUrl,
			'width' => $info->width,
			'height' => $info->height,
			'aspect-ratio' => $info->aspectRatio,
			'author-name' => $info->authorName,
			'author-url' => $info->authorUrl,
			'provider-name' => $info->providerName,
			'provider-url' => $info->providerUrl,
			'provider-icons' => $info->providerIcons,
			'provider-icon' => $info->providerIcon,
			'published-date' => $info->publishedTime,
			'license' => $info->license,
		]);
	}
}
