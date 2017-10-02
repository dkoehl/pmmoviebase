<?php
namespace Pmmoviebase\Pmmoviebase\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 moviedatabase@pm-newmedia.com <moviedatabase@pm-newmedia.com>, pm-newmedia.com
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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * MovieController
 */
class MovieController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * movieRepository
	 *
	 * @var \Pmmoviebase\Pmmoviebase\Domain\Repository\MovieRepository
	 * @inject
	 */
	protected $movieRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
        $args = $this->request->getArguments();
        $findCategory = $args['category']['category'];
        if(!empty($findCategory)){
            $selectedCategory = $findCategory;
            $movies = $this->movieRepository->findAllByCategory($findCategory);
            $categories = $this->movieRepository->findByCategory();
            $this->view->assign('selectedCategory', $selectedCategory);
            $this->view->assign('categories', $categories);
		    $this->view->assign('movies', $movies);
            $slidermovies = $this->movieRepository->findInitialMovies();
		    $this->view->assign('slidermovies', $slidermovies);
        }else{
            $movies = $this->movieRepository->findAll();
            $slidermovies = $this->movieRepository->findInitialMovies();
            $categories = $this->movieRepository->findByCategory();
		    $this->view->assign('slidermovies', $slidermovies);
		    $this->view->assign('movies', $movies);
            $this->view->assign('categories', $categories);
        }
	}


    /**
     * Return random Movie
     * @param $movieCount
     * @return mixed
     */
    public function getRandomMovie($movieCount){
        $allmovies = count($movieCount);
        return $movieCount[rand('0', $allmovies)];
    }

    /**
     * ToDo: Build this function
     */
    public function showFilesystemFolder(){
        $dirs = exec('ls -la /media/movies');
//        DebuggerUtility::var_dump($dirs, 'dirs');
    }

    public function getMovieDetails($movie){
        ///movie/{id}/videos
        $movieId = $movie->getId();
        $requestUrl = "https://api.themoviedb.org/3/movie/".$movieId."/videos?api_key=c19092014ce21b63ebc5c3a2d66b0320&format=JSON&language=de";
        $json = $this->makeApiRequest($requestUrl);
        $trailerInfos = json_decode($json, true);

        $trailerId = $trailerInfos['results']['0']['key'];

        //11934
        ///movie/{id}/credits
        //https://api.themoviedb.org/3/movie/11934/credits?api_key=c19092014ce21b63ebc5c3a2d66b0320&format=JSON&language=de

        if(empty($trailerId)){
            $title = $movie->getOriginaltitle();
            $title = str_replace(array(' ',','), array('-',''), $title);
            $requestUrl = 'http://gdata.youtube.com/feeds/api/videos/-/'.$title.'-Trailer?max-results=10&C+trailer';
            $xmlResultString = $this->makeApiRequest($requestUrl);
            $trailer= json_decode(json_encode((array) @simplexml_load_string($xmlResultString)), TRUE);
            return array('movieId'=>str_replace('http://gdata.youtube.com/feeds/api/videos/','',$trailer['entry']['0']['id']), 'details' => array('title'=>$trailer['entry']['0']['title'],'description'=>$trailer['entry']['0']['content'] ));
        }else{
            return array('trailerId'=>$trailerId, 'credits'=>$this->getMovieCredits($movieId));
        }
    }


    /**
     * @param $movieId
     *
     * @return mixed
     */
    public function getMovieCredits($movieId){
        ///credits/
        $requestUrl = "https://api.themoviedb.org/3/movie/".$movieId."/credits?api_key=c19092014ce21b63ebc5c3a2d66b0320&format=JSON&language=de";
        $json = $this->makeApiRequest($requestUrl);
        return json_decode($json, true);
    }



    /**
     * @param $apiUrl
     *
     * @return mixed
     */
    public function makeApiRequest($apiUrl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'MyBot/1.0 (http://www.mysite.com/)');
        $result = curl_exec($ch);
        if (!$result) {
            DebuggerUtility::var_dump($apiUrl,'apiUUU');
            DebuggerUtility::var_dump(curl_error($ch),'cURL ERRR');
        }else{
            return $result;
        }
    }


    public function searchAction() {
        $args = $this->request->getArguments();
        $results = $this->movieRepository->findBySearch('%'.$args['search']['sword'].'%');
        $this->view->assign('results', $results);
    }


    /**
	 * action show
	 *
	 * @param \Pmmoviebase\Pmmoviebase\Domain\Model\Movie $movie
	 * @return void
	 */
	public function showAction(\Pmmoviebase\Pmmoviebase\Domain\Model\Movie $movie) {
//        $requestUrl = 'http://trailersapi.com/trailers.json?movie='.$title.'&limit=5&width=320';
//        $requestUrl = 'http://api.traileraddict.com/?film='.$title.'&count=3';

        $movieDetails = $this->getMovieDetails($movie);
        if(empty($movieDetails['trailerId'])){
            $this->view->assign('trailer', $movieDetails);
        }else{
            $this->view->assign('trailerId', $movieDetails['trailerId']);
            $this->view->assign('credits', $movieDetails['credits']['cast']);
        }
        $this->view->assign('movie', $movie);
	}

}