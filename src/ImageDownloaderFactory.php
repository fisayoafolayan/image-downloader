<?php

namespace FisayoAfolayan\ImageDownloader;

use FisayoAfolayan\ImageDownloader\Controller\ImageDownloadController;
use FisayoAfolayan\ImageDownloader\Client\Client;
use FisayoAfolayan\ImageDownloader\Client\ClientInterface;
use FisayoAfolayan\ImageDownloader\DirectoryHandler\DirectoryStructureHandler;
use FisayoAfolayan\ImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\ImageDownloader\Reader\TxtReader;
use FisayoAfolayan\ImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\ImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\ImageDownloader\Service\ImageDownloaderService;
use FisayoAfolayan\ImageDownloader\Service\ImageDownloaderServiceInterface;
use FisayoAfolayan\ImageDownloader\Validator\ImageTypeValidator;
use FisayoAfolayan\ImageDownloader\Validator\ImageTypeValidatorInterface;

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