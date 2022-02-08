<?php

namespace FisayoAfolayan\ImageDownloader\Controller;

use FisayoAfolayan\ImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\ImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\ImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\ImageDownloader\Service\ImageDownloaderServiceInterface;

class ImageDownloadController
{

    private ImageDownloaderConfig $getConfig;
    private array $imageUrls;
    private ImageDownloaderServiceInterface $imageDownloaderService;
    private DirectoryStructureHandlerInterface $directoryStructureHandler;


    /**
     * @param ImageDownloaderConfig              $config
     * @param TxtReaderInterface                 $textReader
     * @param ImageDownloaderServiceInterface    $imageDownloaderService
     * @param DirectoryStructureHandlerInterface $directoryStructureHandler
     */
    public function __construct(
        ImageDownloaderConfig $config,
        TxtReaderInterface $textReader,
        ImageDownloaderServiceInterface $imageDownloaderService,
        DirectoryStructureHandlerInterface $directoryStructureHandler
    ) {
        $this->getConfig = $config;
        $this->imageUrls = $textReader->getImageUrlsFromTextFile();
        $this->imageDownloaderService = $imageDownloaderService;
        $this->directoryStructureHandler = $directoryStructureHandler;
    }



    public function downloadImages()
    {
        if (empty($this->imageUrls)) {
            // todo return valid exception here
            echo "File Empty";
            return null;
        }

        $directoryName = $this->directoryStructureHandler->createDirectory();
        $batchSize = $this->getConfig->getImageDownloadBatchSize();


        $numberOfProcesses = count(
            array_chunk(
                $this->imageUrls,
                $this->getConfig->getImageDownloadBatchSize()
            )
        );

        // Iterates through batches and downloads images
        for ($i =0; $i < $numberOfProcesses ; $i++) {
            $imageUrlsPerBatch = array_splice($this->imageUrls, 0, $batchSize);
            $this->imageUrls = array_values($this->imageUrls);
            $this->imageDownloaderService->downloadImages($imageUrlsPerBatch, $directoryName);
        }
    }



}