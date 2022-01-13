<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler;


use FisayoAfolayan\GetSafeBatchImageDownloader\Client\ClientInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidatorInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

class DirectoryStructureHandler implements DirectoryStructureHandlerInterface
{
    private ImageDownloaderConfig $getConfig;

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config) {
        $this->getConfig = $config;
    }

    /**
     * @return string
     *
     * @throws \League\Flysystem\FilesystemException
     */
    public function createDirectory(): string
    {
        $dirname = date('m-d-Y_H:i:s');
        $this->initiateFilesystem()->createDirectory($dirname);

        return $dirname;
    }

    /**
     * @param string $location
     *
     * @return bool
     * @throws \League\Flysystem\FilesystemException
     */
    public function checkIfFileExist(string $location): bool
    {
        return $this->initiateFilesystem()->fileExists($location);
    }

    /**
     * @return Filesystem
     */
    public function initiateFilesystem(): Filesystem
    {
        $adapter = new LocalFilesystemAdapter(
            $this->getConfig->getImageDownloadPath()
        );
        return new Filesystem($adapter);
    }

}