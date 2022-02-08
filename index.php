<?php

use FisayoAfolayan\ImageDownloader\ImageDownloaderFacade;

define('APPLICATION_ROOT_DIR', realpath(__DIR__));

require_once  'vendor/autoload.php';


$runDownloader = new ImageDownloaderFacade();

$runDownloader->runDownload();




