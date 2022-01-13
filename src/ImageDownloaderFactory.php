<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader;


use FisayoAfolayan\GetSafeBatchImageDownloader\Adapter\ImageDownloadAdapter;
use FisayoAfolayan\GetSafeBatchImageDownloader\Adapter\ImageDownloadAdapterInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\Client;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\ClientInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandler;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReader;
use FisayoAfolayan\GetSafeBatchImageDownloader\config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidator;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidatorInterface;

class ImageDownloaderFactory
{

    /**
     * @return ImageDownloadAdapterInterface
     */
    public function createImageDownloadAdapter(): ImageDownloadAdapterInterface
    {
        return new ImageDownloadAdapter(
            $this->getConfig(),
            $this->createCSVReader(),
            $this->createImageTypeValidator(),
            $this->createClient()
        );
    }

    /**
     * @return TxtReader
     */
    public function createCSVReader(): TxtReader
    {
        return new TxtReader($this->getConfig());

    }

    /**
     * @return ImageTypeValidatorInterface
     */
    public function createImageTypeValidator(): ImageTypeValidatorInterface
    {
        return new ImageTypeValidator($this->getConfig());

    }

    /**
     * @return ClientInterface
     */
    public function createClient(): ClientInterface
    {
        return new Client(
            $this->getConfig(),
            $this->createDirectoryStructureHandler()
        );

    }

    /**
     * @return DirectoryStructureHandler
     */
    public function createDirectoryStructureHandler(): DirectoryStructureHandler
    {
        return new DirectoryStructureHandler(
            $this->getConfig()
        );

    }


    /**
     * @return ImageDownloaderConfig
     */
    public function getConfig(): ImageDownloaderConfig
    {
        return new ImageDownloaderConfig();
    }

}