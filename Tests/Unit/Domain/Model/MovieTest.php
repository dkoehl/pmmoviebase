<?php

namespace Pmmoviebase\Pmmoviebase\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 moviedatabase@pm-newmedia.com <moviedatabase@pm-newmedia.com>, pm-newmedia.com
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Pmmoviebase\Pmmoviebase\Domain\Model\Movie.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author moviedatabase@pm-newmedia.com <moviedatabase@pm-newmedia.com>
 */
class MovieTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Pmmoviebase\Pmmoviebase\Domain\Model\Movie
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Pmmoviebase\Pmmoviebase\Domain\Model\Movie();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getOriginaltitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getOriginaltitle()
		);
	}

	/**
	 * @test
	 */
	public function setOriginaltitleForStringSetsOriginaltitle() {
		$this->subject->setOriginaltitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'originaltitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getReleasedateReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getReleasedate()
		);
	}

	/**
	 * @test
	 */
	public function setReleasedateForStringSetsReleasedate() {
		$this->subject->setReleasedate('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'releasedate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForStringSetsImage() {
		$this->subject->setImage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBackdroppathReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBackdroppath()
		);
	}

	/**
	 * @test
	 */
	public function setBackdroppathForStringSetsBackdroppath() {
		$this->subject->setBackdroppath('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'backdroppath',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getId()
		);
	}

	/**
	 * @test
	 */
	public function setIdForStringSetsId() {
		$this->subject->setId('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'id',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPopularityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPopularity()
		);
	}

	/**
	 * @test
	 */
	public function setPopularityForStringSetsPopularity() {
		$this->subject->setPopularity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'popularity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForStringSetsCategory() {
		$this->subject->setCategory('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFilenameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFilename()
		);
	}

	/**
	 * @test
	 */
	public function setFilenameForStringSetsFilename() {
		$this->subject->setFilename('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'filename',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYearReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getYear()
		);
	}

	/**
	 * @test
	 */
	public function setYearForStringSetsYear() {
		$this->subject->setYear('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'year',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getParentalReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getParental()
		);
	}

	/**
	 * @test
	 */
	public function setParentalForStringSetsParental() {
		$this->subject->setParental('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'parental',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOverviewReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getOverview()
		);
	}

	/**
	 * @test
	 */
	public function setOverviewForStringSetsOverview() {
		$this->subject->setOverview('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'overview',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVotesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getVotes()
		);
	}

	/**
	 * @test
	 */
	public function setVotesForStringSetsVotes() {
		$this->subject->setVotes('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'votes',
			$this->subject
		);
	}
}
