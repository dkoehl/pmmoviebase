<?php
namespace Pmmoviebase\Pmmoviebase\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 moviedatabase@pm-newmedia.com <moviedatabase@pm-newmedia.com>, pm-newmedia.com
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Movie
 */
class Movie extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * originaltitle
	 *
	 * @var string
	 */
	protected $originaltitle = '';

	/**
	 * releasedate
	 *
	 * @var string
	 */
	protected $releasedate = '';

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * image
	 *
	 * @var string
	 */
	protected $image = '';

	/**
	 * backdroppath
	 *
	 * @var string
	 */
	protected $backdroppath = '';

	/**
	 * id
	 *
	 * @var string
	 */
	protected $id = '';

	/**
	 * popularity
	 *
	 * @var string
	 */
	protected $popularity = '';

	/**
	 * category
	 *
	 * @var string
	 */
	protected $category = '';

	/**
	 * filename
	 *
	 * @var string
	 */
	protected $filename = '';

	/**
	 * year
	 *
	 * @var string
	 */
	protected $year = '';

	/**
	 * parental
	 *
	 * @var string
	 */
	protected $parental = '';

	/**
	 * overview
	 *
	 * @var string
	 */
	protected $overview = '';

	/**
	 * votes
	 *
	 * @var string
	 */
	protected $votes = '';


	/**
	 * hash
	 *
	 * @var string
	 */
	protected $hash = '';

	/**
	 * Returns the originaltitle
	 *
	 * @return string $originaltitle
	 */
	public function getOriginaltitle() {
		return $this->originaltitle;
	}

	/**
	 * Sets the originaltitle
	 *
	 * @param string $originaltitle
	 * @return void
	 */
	public function setOriginaltitle($originaltitle) {
		$this->originaltitle = $originaltitle;
	}

	/**
	 * Returns the releasedate
	 *
	 * @return string $releasedate
	 */
	public function getReleasedate() {
		return $this->releasedate;
	}

	/**
	 * Sets the releasedate
	 *
	 * @param string $releasedate
	 * @return void
	 */
	public function setReleasedate($releasedate) {
		$this->releasedate = $releasedate;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the backdroppath
	 *
	 * @return string $backdroppath
	 */
	public function getBackdroppath() {
		return $this->backdroppath;
	}

	/**
	 * Sets the backdroppath
	 *
	 * @param string $backdroppath
	 * @return void
	 */
	public function setBackdroppath($backdroppath) {
		$this->backdroppath = $backdroppath;
	}

	/**
	 * Returns the id
	 *
	 * @return string $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Sets the id
	 *
	 * @param string $id
	 * @return void
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Returns the popularity
	 *
	 * @return string $popularity
	 */
	public function getPopularity() {
		return $this->popularity;
	}

	/**
	 * Sets the popularity
	 *
	 * @param string $popularity
	 * @return void
	 */
	public function setPopularity($popularity) {
		$this->popularity = $popularity;
	}

	/**
	 * Returns the category
	 *
	 * @return string $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param string $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Returns the filename
	 *
	 * @return string $filename
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * Sets the filename
	 *
	 * @param string $filename
	 * @return void
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * Returns the year
	 *
	 * @return string $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Sets the year
	 *
	 * @param string $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * Returns the parental
	 *
	 * @return string $parental
	 */
	public function getParental() {
		return $this->parental;
	}

	/**
	 * Sets the parental
	 *
	 * @param string $parental
	 * @return void
	 */
	public function setParental($parental) {
		$this->parental = $parental;
	}

	/**
	 * Returns the overview
	 *
	 * @return string $overview
	 */
	public function getOverview() {
		return $this->overview;
	}

	/**
	 * Sets the overview
	 *
	 * @param string $overview
	 * @return void
	 */
	public function setOverview($overview) {
		$this->overview = $overview;
	}

	/**
	 * Returns the votes
	 *
	 * @return string $votes
	 */
	public function getVotes() {
		return $this->votes;
	}

	/**
	 * Sets the votes
	 *
	 * @param string $votes
	 * @return void
	 */
	public function setVotes($votes) {
		$this->votes = $votes;
	}

	/**
	 * Returns the hash
	 *
	 * @return string $hash
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Sets the hash
	 *
	 * @param string $hash
	 * @return void
	 */
	public function setHash($hash) {
		$this->hash = md5(trim($hash));
	}
}