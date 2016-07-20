<?php
namespace gossi\trixionary;

use Cocur\Slugify\Slugify;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\Sport;
use keeko\framework\foundation\AbstractModule;
use Propel\Runtime\Propel;
use phootwork\file\Path;

/**
 * Trixionary API
 *
 * @license MIT
 * @author gossi
 */
class TrixionaryModule extends AbstractModule {

	/**
	 */
	public function install() {
		// install sql
		$files = ['sql/keeko.sql'];

		if (KEEKO_ENVIRONMENT == KEEKO_DEVELOPMENT) {
			$files[] = 'data/unicycling.sql';
		}

		try {
			$repo = $this->getServiceContainer()->getResourceRepository();
			$con = Propel::getConnection();
			foreach ($files as $file) {
				if ($repo->contains('/gossi/trixionary/database/' . $file)) {
					$sql = $repo->get('/gossi/trixionary/database/' . $file)->getBody();
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 */
	public function uninstall() {
	}

	/**
	 * @param mixed $from
	 * @param mixed $to
	 */
	public function update($from, $to) {
	}

	/**
	 * Returns the upload segment for path and url
	 * @return string
	 */
	public function getUploadSegment() {
		return '_uploads';
	}

	/**
	 * Returns the upload path
	 * @return Path
	 */
	public function getUploadPath() {
		return $this->getFilesPath()->append($this->getUploadSegment());
	}

	/**
	 * Returns the upload url
	 * @return string
	 */
	public function getUploadUrl() {
		return $this->getFilesUrl($this->getUploadSegment());
	}

	/**
	 * Returns the segment for the given sport
	 * @param Sport $sport
	 * @return string
	 */
	public function getSportSegment(Sport $sport) {
		// TODO: Get slug in default locale
		return $sport->getSlug();
	}

	/**
	 * Returns the path for the given sport
	 * @param Sport $sport
	 * @return Path
	 */
	public function getSportPath(Sport $sport) {
		return $this->getFilesPath()->append($this->getSportSegment($sport));
	}

	/**
	 * Returns the url for the given sport
	 * @param Sport $sport
	 * @return string
	 */
	public function getSportUrl(Sport $sport) {
		return $this->getFilesUrl($this->getSportSegment($sport));
	}

	/**
	 * Returns the file name for the default skill preview image
	 * @return string
	 */
	public function getSkillPreviewSegment() {
		return 'skill.jpg';
	}

	/**
	 * Returns the path for the default skill preview image
	 * @param Sport $sport
	 * @return Path
	 */
	public function getSkillPreviewPath(Sport $sport) {
		return $this->getSportPath($sport)->append($this->getSkillPreviewSegment());
	}

	/**
	 * Returns the url for the default skill preview image
	 * @param Sport $sport
	 * @return string
	 */
	public function getSkillPreviewUrl(Sport $sport) {
		return $this->getSportUrl($sport) . '/' . $this->getSkillPreviewSegment();
	}

	/**
	 * Returns the segment for skills for the given sport
	 * @param Sport $sport
	 * @return string
	 */
	public function getSkillsSegment(Sport $sport) {
		// TODO: Get slug in default locale
		$slugifier = new Slugify();
		return $slugifier->slugify($sport->getSkillPluralLabel());
	}

	/**
	 * Returns the path for skills for the given sport
	 * @param Sport $sport
	 * @return Path
	 */
	public function getSkillsPath(Sport $sport) {
		return $this->getSportPath($sport)->append($this->getSkillsSegment($sport));
	}

	/**
	 * Returns the url for skills for the given sport
	 * @param Sport $sport
	 * @return string
	 */
	public function getSkillsUrl(Sport $sport) {
		return $this->getSportUrl($sport) . '/' . $this->getSkillsSegment($sport);
	}

	/**
	 * Returns the segment for the given skill
	 * @param Skill $skill
	 * @return string
	 */
	public function getSkillSegment(Skill $skill) {
		// TODO: Get slug in default locale
		return $skill->getSlug();
	}

	/**
	 * Returns the path for the given skill
	 * @param Skill $skill
	 * @return Path
	 */
	public function getSkillPath(Skill $skill) {
		return $this->getSkillsPath($skill->getSport())->append($this->getSkillSegment($skill));
	}

	/**
	 * Returns the url for the given skill
	 * @param Skill $skill
	 * @return string
	 */
	public function getSkillUrl(Skill $skill) {
		return $this->getSkillsUrl($skill->getSport()) . '/' . $this->getSkillSegment($skill);
	}

	/**
	 * Returns the segment for pictures
	 * @return string
	 */
	public function getPicturesSegment() {
		return 'pictures';
	}

	/**
	 * Returns the pictures path for the given skill
	 * @param Skill $skill
	 * @return Path
	 */
	public function getPicturesPath(Skill $skill) {
		return $this->getSkillPath($skill)->append($this->getPicturesSegment());
	}

	/**
	 * Returns the pictures url for the given skill
	 * @param Skill $skill
	 * @return string
	 */
	public function getPicturesUrl(Skill $skill) {
		return $this->getSkillUrl($skill) . '/' . $this->getPicturesSegment();
	}

	/**
	 * Returns the segment for videos
	 * @return string
	 */
	public function getVideosSegment() {
		return 'videos';
	}

	/**
	 * Returns the videos path for the given skill
	 * @param Skill $skill
	 * @return Path
	 */
	public function getVideosPath(Skill $skill) {
		return $this->getSkillPath($skill)->append($this->getVideosSegment());
	}

	/**
	 * Returns the videos url for the given skill
	 * @param Skill $skill
	 * @return string
	 */
	public function getVideosUrl(Skill $skill) {
		return $this->getSkillUrl($skill) . '/' . $this->getVideosSegment();
	}

	/**
	 * Returns the segment for a sequence image
	 * @return string
	 */
	public function getSequenceSegment() {
		return 'sequence.jpg';
	}

	/**
	 * Returns the sequence path for the given skill
	 * @param Skill $skill
	 * @return Path
	 */
	public function getSequencePath(Skill $skill) {
		return $this->getSkillPath($skill)->append($this->getSequenceSegment());
	}

	/**
	 * Returns the sequence url for the given skill
	 * @param Skill $skill
	 * @return string
	 */
	public function getSequenceUrl(Skill $skill) {
		return $this->getSkillUrl($skill) . '/' . $this->getSequenceSegment();
	}

}
