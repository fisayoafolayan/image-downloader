<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Reader;

use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;

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
     * @return string[]
     */
    public function readTxtFile(): array
    {
        $imageUrlContent = file($this->getConfig->getImageImportPath(), FILE_IGNORE_NEW_LINES);

        return explode(' ', $imageUrlContent[0]);
    }

}