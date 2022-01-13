<?php

use FisayoAfolayan\GetSafeBatchImageDownloader\Constants\ImageDownloaderConstants;

$config[ImageDownloaderConstants::IMAGE_IMPORT_PATH] = APPLICATION_ROOT_DIR . '/data/import/aww_dataset.txt';
$config[ImageDownloaderConstants::IMAGE_DOWNLOAD_PATH] = APPLICATION_ROOT_DIR . '/data/downloads';
$config[ImageDownloaderConstants::IMAGE_DOWNLOAD_BATCH_SIZE] = 10;
$config[ImageDownloaderConstants::IMAGE_EXTENSION_TYPES] = [
    'jpg',
    'jpeg',
    'png'
];
