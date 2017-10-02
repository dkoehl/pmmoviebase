<?php
namespace Pmmoviebase\Pmmoviebase\Domain\Repository;


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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for Movies
 */
class MovieRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {


    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'votes' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );


    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInitialMovies(){
        $query = $this->createQuery();
        $query->matching(
            $query->greaterthan('votes', 6)

        );
        $query->setLimit(20);
        return $query->execute();



    }


    /**
     * @param $sword
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findBySearch($sword) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                    $query->like('title', $sword), $query->like('originaltitle', $sword)
            )
        );
        return $query->execute();
    }


    /**
     * @param $apiDataArray
     */
    public function insertDataFromApi($apiDataArray){
        $apiDataArray['pid'] = '37';
//        \t3lib_utility_Debug::debug($apiDataArray, 'insertArray');
        $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_pmmoviebase_domain_model_movie',$apiDataArray , $no_quote_fields=FALSE );

    }
    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByCategory(){
        $query = $this->createQuery();
        $query->statement('SELECT DISTINCT category from tx_pmmoviebase_domain_model_movie');
        return $query->execute(1);
    }
    /**
     * @param $category
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllByCategory($category){
        $query = $this->createQuery();
        $query->matching($query->equals('category', $category));
        return $query->execute();
    }


}