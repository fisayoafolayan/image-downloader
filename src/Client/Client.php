<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Client;


use FisayoAfolayan\GetSafeBatchImageDownloader\config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;

class Client implements ClientInterface
{
    private ImageDownloaderConfig $getConfig;
    private DirectoryStructureHandlerInterface $directoryStructureHandler;

    /**
     * @param ImageDownloaderConfig $config
     * @param DirectoryStructureHandlerInterface $directoryStructureHandler
     */
    public function __construct(
        ImageDownloaderConfig $config,
        DirectoryStructureHandlerInterface $directoryStructureHandler
    ) {
        $this->getConfig = $config;
        $this->directoryStructureHandler = $directoryStructureHandler;
    }

    public function downloadImages(array $imageUrls)
    {
        $directoryName = $this->directoryStructureHandler->createDirectory();
        foreach ($imageUrls as $imageUrl) {
            $filename = basename($imageUrl);
            $filePath = $this->getConfig->getImageDownloadPath(). '/' . $directoryName . '/' . $filename;
            if ($this->directoryStructureHandler->checkIfFileExist($directoryName . '/' . $filename)) {
                continue;
            }
            $fileDirectory = $this->getConfig->getImageDownloadPath(). '/' . $directoryName;
            $downloadImage = copy($imageUrl, $filePath);
        }

    }

}