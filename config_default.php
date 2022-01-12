<?php

use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderConstants\ImageDownloaderConstants;

$config[ImageDownloaderConstants::IMAGE_IMPORT_PATH] = APPLICATION_ROOT_DIR . '/src/data/import/CSV/aww_dataset_short.csv';
$config[ImageDownloaderConstants::IMAGE_DOWNLOAD_PATH] = APPLICATION_ROOT_DIR . '/src/data/downloads/';
$config[ImageDownloaderConstants::IMAGE_COUNT_PER_DOWNLOAD] = 15;
