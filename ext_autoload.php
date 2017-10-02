<?php
$extpath = t3lib_extMgm::extPath('pmmoviebase');
$extensionClassesPath = t3lib_extMgm::extPath('pmmoviebase') . 'Classes/';
return array(
    'Tx_MovieScraperCommandController' => $extpath . 'Classes/Command/MovieScraper.php',
);


?>