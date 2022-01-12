<?php

use FisayoAfolayan\GetSafeBatchImageDownloader\config\ImageDownloaderConfig;

define('APPLICATION_ROOT_DIR', realpath(__DIR__));

require_once  'vendor/autoload.php';

require APPLICATION_ROOT_DIR . '/src/config/ImageDownloaderConfig.php';


$ksfs = new ImageDownloaderConfig();

echo $ksfs->getImageImportPath();

//$filename = 'src/data/import/CSV/aww_dataset_short.csv';


