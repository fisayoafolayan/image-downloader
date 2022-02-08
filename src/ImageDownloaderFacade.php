<?php

namespace FisayoAfolayan\ImageDownloader;

class ImageDownloaderFacade implements ImageDownloaderFacadeInterface
{

    /**
     * @return null
     */
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