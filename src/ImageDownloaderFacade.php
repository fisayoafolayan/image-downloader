<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader;

class ImageDownloaderFacade implements ImageDownloaderFacadeInterface
{

    public function runDownload()
    {
        return $this->createImageDownloaderFactory()
            ->createImageDownloadController()
            ->downloadImages();
    }

    /**
     * @return ImageDownloaderFactory
     */
    public function createImageDownloaderFactory(): ImageDownloaderFactory
    {
        return new ImageDownloaderFactory();
    }

}