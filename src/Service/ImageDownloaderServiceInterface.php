<?php

namespace FisayoAfolayan\ImageDownloader\Service;


interface ImageDownloaderServiceInterface
{
    /**
     * @param array  $imagesUrl
     * @param string $directoryName
     */
    public function downloadImages(array $imagesUrl, string $directoryName): void;

}