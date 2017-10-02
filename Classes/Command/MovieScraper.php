<?php
namespace Pmmoviebase\Pmmoviebase\Command;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 *
 * Gets Data from external Movie APIs
 */
class MovieScraper extends \TYPO3\CMS\Scheduler\Task\AbstractTask
{
    /**
     * @var String $movieList
     */
    private $movieList;

    /**
     * Files with moviedata
     */
    const MOVIELISTFILE = 'movielist.txt';
    const MOVIELISTFILE_TEST = 'movie_test.txt';
    const MOVIEAPIKEY = 'YOUR-KEY-HERE';
    const ROTTENTOMATO_APIKEY = 'YOUR-KEY-HERE';
    /**
     * movieRepository
     *
     * @var \Pmmoviebase\Pmmoviebase\Domain\Repository\MovieRepository
     * @inject
     */
    protected $movieRepository = NULL;

    /**
     * @param \Pmmoviebase\Pmmoviebase\Domain\Repository\MovieRepository $movieRepository
     */
    public function injectEventRepository (\Pmmoviebase\Pmmoviebase\Domain\Repository\MovieRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @return bool
     */
    public function execute() {
        $this->logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
        $this->logger->info('Import gestartet');

        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
        $this->settings = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        $configurationArray = array('persistence' => array('storagePid' => '41'));
        $configurationManager->setConfiguration($configurationArray);
        // Get Repos
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $movieRepository = $objectManager->get('Pmmoviebase\\Pmmoviebase\\Domain\\Repository\\MovieRepository');

        $movieFileArray = $this->loadMovieDataFile();
        $movietitleArray = [];
        $count=0;
        foreach($movieFileArray as $item){
            $movietitle = $this->getTitleFromFileName($item);         // Checkt erst mal nur, Filmnamen mit (Date)
            if(!empty($movietitle)){
                if(!in_array(md5(trim($movietitle)), $movietitleArray)){
                    $movietitleArray[] = md5(trim($movietitle));
                    $this->logger->info('Gesucht wird: ' . $item);
                    $checkforexistingmovie = $movieRepository->findByHash(md5(trim($movietitle)));
                    if(empty($checkforexistingmovie['0'])){
                       // process here
                        $tmpArray = array(
                            'title'         => $movietitle,
                            'year'          => $this->getDateFromFileName($item),
                            'filename'      => str_replace('./', '', $item),
                            'category'      => $this->getFolderForCategory($item),
                        );
                        $apiResponseJson = $this->makeApiRequest($this->buildApiLink($tmpArray));
                        $apiData = json_decode($apiResponseJson);
                        if(!empty($apiData->results)){
                            $newMovieData = new \Pmmoviebase\Pmmoviebase\Domain\Model\Movie;
                            $newMovieData->setBackdroppath($this->getMediaFromApi($apiData->results['0']->backdrop_path, $apiData->results['0']->id));
                            $newMovieData->setImage($this->getMediaFromApi($apiData->results['0']->poster_path, $apiData->results['0']->id));
                            $newMovieData->setOriginaltitle($apiData->results['0']->original_title);
                            $newMovieData->setTitle($apiData->results['0']->title);
                            $newMovieData->setId($apiData->results['0']->id);
                            $newMovieData->setPopularity($apiData->results['0']->popularity);
                            $newMovieData->setCategory($tmpArray['category']);
                            $newMovieData->setFilename(str_replace('./','',$item));
                            $newMovieData->setYear($tmpArray['year']);
                            $newMovieData->setReleasedate($apiData->results['0']->release_date);
//                            $newMovieData->setParental($apiData->results['0']->backdrop_path);
                            $newMovieData->setOverview($apiData->results['0']->overview);
                            $newMovieData->setVotes($apiData->results['0']->vote_average);
                            $newMovieData->setHash($movietitle);
                            $movieRepository->add($newMovieData);
                            $persistenceManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
                            $persistenceManager->persistAll();
                        }else{
                            $this->logger->info('Kein API ergebnis: ' . $movietitle);
                        }
                    }else{
                        $this->logger->info('War schon in DB vorhanden: ' . $movietitle);
                    }
                }
            }else{
                // log
                $this->logger->info('FileItem wurde nicht erkannt: ' . $item);
            }
        }
        return true;
    }
    /**
     * @param $tmpMovieArray
     *
     * @return string
     */
    public function buildApiLink($tmpMovieArray){
        $apikey = self::MOVIEAPIKEY;
        $rottentomato_apikey = self::ROTTENTOMATO_APIKEY;


        if($fileArray['category'] == 'Serien'){
            if(is_numeric($tmpMovieArray['year']) && !empty($tmpMovieArray['title'])){
                $requestUrl = "https://api.themoviedb.org/3/search/tv?api_key=".self::MOVIEAPIKEY."&query=".urlencode($tmpMovieArray['title'])."&searchYear=".$tmpMovieArray['year']."&format=JSON&language=de&alternativeTitles=0&append_to_response=releases,trailers";
            }else{
                $requestUrl = "https://api.themoviedb.org/3/search/tv?api_key=".self::MOVIEAPIKEY."&query=".urlencode($tmpMovieArray['title'])."&format=JSON&language=de&alternativeTitles=0&append_to_response=releases,trailers";
            }
        }else{
            if(is_numeric($tmpMovieArray['year']) && !empty($tmpMovieArray['title'])){
                $requestUrl = "https://api.themoviedb.org/3/search/movie?api_key=".self::MOVIEAPIKEY."&query=".urlencode($tmpMovieArray['title'])."&searchYear=".$tmpMovieArray['year']."&format=JSON&language=de&alternativeTitles=0&append_to_response=releases,trailers";
            }else{
                $requestUrl = "https://api.themoviedb.org/3/search/movie?api_key=".self::MOVIEAPIKEY."&query=".urlencode($tmpMovieArray['title'])."&format=JSON&language=de&alternativeTitles=0&append_to_response=releases,trailers";
            }
        }
        return trim($requestUrl);
    }

    /**
     * @return array
     */
    public function loadMovieDataFile(){
        $local_file = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('pmmoviebase') . self::MOVIELISTFILE;
        $fileString = file_get_contents($local_file);
        return explode("\n", $fileString);
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
        curl_setopt($ch, CURLOPT_USERAGENT, 'aPiChecker/1.0 (http://www.checkapi.com/)');
        $result = curl_exec($ch);
        if (!$result) {
            $this->logger->info('CURL Api ERROR : ' . curl_error($ch));
            $this->logger->info('CURL Api ERROR Url : ' . $apiUrl);
        }else{
            return $result;
        }
    }

    /**
     * @param $moviemedia
     * @param $movieid
     * @return string
     */
    public function getMediaFromApi($moviemedia, $movieid){
        if(!empty($moviemedia)){
            $basePath = 'fileadmin/tx_pmmoviebase/';
            if(!is_dir(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($basePath))){
                \TYPO3\CMS\Core\Utility\GeneralUtility::mkdir(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($basePath));
            }
            $movieStoragePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($basePath . $movieid . '/');
            if(!is_dir($movieStoragePath)){
                \TYPO3\CMS\Core\Utility\GeneralUtility::mkdir($movieStoragePath);
            }
            if(false == file_put_contents($movieStoragePath.str_replace('/','',$moviemedia), file_get_contents('http://image.tmdb.org/t/p/w500'.$moviemedia))){
                $this->logger->info('FEHLER beim speichern von Bild: ' . $movieid);
            }else{
                return $basePath.$movieid.$moviemedia;
            }
        }
    }
    /**
     * @param $filename
     *
     * @return mixed
     */
    public function getTitleFromFileName($filename){
        preg_match('/([0-9a-zA-z_ÄäÖöàÜ$üèß®é &-.,!]*)\(.{1,5}?\)/', $filename, $match);
        if(!empty($match['0'])){
            return trim($match[1]);
        }
    }
    /**
     * @param $filename
     *
     * @return mixed
     */
    public function getFolderForCategory($filename){
        preg_match('/(\.\/)(.*?)(\/)/', $filename, $match);
        if(!empty($match)){
            return trim($match['2']);
        }
    }
    /**
     * @param $filename
     *
     * @return mixed
     */
    public function getDateFromFileName($filename){
        preg_match('/\((.*?)\)/', $filename, $match);
        if(!empty($match)){
            return trim(str_replace(array('TV','Video'), array('',''), $match['1']));
        }
    }
    /**
     *
     * Helper/Wrapper function for Flash messages inside the typo3 backend
     *
     * @param string             $title
     * @param string             $message
     * @param t3lib_FlashMessage $type
     */
    public static function showMessage($title, $message, $type) {
        $msg = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage', $message, $title, // the header is optional
            \TYPO3\CMS\Core\Messaging\FlashMessage::OK, // the severity is optional as well and defaults to \TYPO3\CMS\Core\Messaging\FlashMessage::OK
            TRUE // optional, whether the message should be stored in the session or only in the \TYPO3\CMS\Core\Messaging\FlashMessageQueue object (default is FALSE)
        );
        \TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage($msg);
    }
}
?>