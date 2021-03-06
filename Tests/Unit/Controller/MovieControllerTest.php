<?php
namespace Pmmoviebase\Pmmoviebase\Tests\Unit\Controller;
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
 * Test case for class Pmmoviebase\Pmmoviebase\Controller\MovieController.
 *
 * @author moviedatabase@pm-newmedia.com <moviedatabase@pm-newmedia.com>
 */
class MovieControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Pmmoviebase\Pmmoviebase\Controller\MovieController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Pmmoviebase\\Pmmoviebase\\Controller\\MovieController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMoviesFromRepositoryAndAssignsThemToView() {

		$allMovies = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$movieRepository = $this->getMock('Pmmoviebase\\Pmmoviebase\\Domain\\Repository\\MovieRepository', array('findAll'), array(), '', FALSE);
		$movieRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMovies));
		$this->inject($this->subject, 'movieRepository', $movieRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('movies', $allMovies);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMovieToView() {
		$movie = new \Pmmoviebase\Pmmoviebase\Domain\Model\Movie();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('movie', $movie);

		$this->subject->showAction($movie);
	}
}
