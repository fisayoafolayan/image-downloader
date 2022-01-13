<?php


namespace FisayoAfolayan\GetSafeBatchImageDownloader\Reader;


use FisayoAfolayan\GetSafeBatchImageDownloader\config\ImageDownloaderConfig;

class TxtReader implements TxtReaderInterface
{

    private ImageDownloaderConfig $getConfig;

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config) {
        $this->getConfig = $config;
    }


    /**
     * @return false|string[]
     */
    public function readTxtFile()
    {
        $imageUrlContent = file($this->getConfig->getImageImportPath(), FILE_IGNORE_NEW_LINES);

        return explode(' ', $imageUrlContent[0]);
    }


}