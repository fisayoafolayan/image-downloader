<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader;

use FisayoAfolayan\GetSafeBatchImageDownloader\Controller\ImageDownloadController;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\Client;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\ClientInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandler;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReader;
use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Service\ImageDownloaderService;
use FisayoAfolayan\GetSafeBatchImageDownloader\Service\ImageDownloaderServiceInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidator;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidatorInterface;

class ImageDownloaderFactory
{

    /**
     * @return ImageDownloadController
     */
    public function createImageDownloadController(): ImageDownloadController
    {
        return new ImageDownloadController(
            $this->getConfig(),
            $this->createTXTReader(),
            $this->createImageDownloaderService(),
            $this->createDirectoryStructureHandler()
        );
    }

    /**
     * @return TxtReaderInterface
     */
    public function createTXTReader(): TxtReaderInterface
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
     * @return ImageDownloaderServiceInterface
     */
    public function createImageDownloaderService(): ImageDownloaderServiceInterface
    {
        return new ImageDownloaderService(
            $this->createImageTypeValidator(),
            $this->createClient()
        );

    }

    /**
     * @return DirectoryStructureHandlerInterface
     */
    public function createDirectoryStructureHandler(): DirectoryStructureHandlerInterface
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