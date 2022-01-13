<?php

use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderFacade;

define('APPLICATION_ROOT_DIR', realpath(__DIR__));

require_once  'vendor/autoload.php';


$runDownloader = new ImageDownloaderFacade();

$runDownloader->runDownload();




