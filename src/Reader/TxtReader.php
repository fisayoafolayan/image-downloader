<?php

namespace FisayoAfolayan\ImageDownloader\Reader;

use FisayoAfolayan\ImageDownloader\Config\ImageDownloaderConfig;

class TxtReader implements TxtReaderInterface
{
    private ImageDownloaderConfig $getConfig;

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config)
    {
        $this->getConfig = $config;
    }

    /**
     * @return string[]
     */
    public function getImageUrlsFromTextFile(): array
    {
        $imageUrlContent = file($this->getConfig->getImageImportPath(), FILE_IGNORE_NEW_LINES);

        if ($imageUrlContent) {
            return explode(' ', $imageUrlContent[0]);
        }
        return [];
    }

}