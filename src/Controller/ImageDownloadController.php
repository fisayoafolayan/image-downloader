<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Controller;


use FisayoAfolayan\GetSafeBatchImageDownloader\Client\Client;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\ClientInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Service\ImageBatchServiceInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Service\ImageDownloaderServiceInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidator;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidatorInterface;

class ImageDownloadController
{

    private ImageDownloaderConfig $getConfig;
    private array $imageUrls;
    private ImageDownloaderServiceInterface $imageDownloaderService;
    private DirectoryStructureHandlerInterface $directoryStructureHandler;


    /**
     * @param ImageDownloaderConfig $config
     * @param TxtReaderInterface $textReader
     * @param ImageDownloaderServiceInterface $imageDownloaderService
     * @param DirectoryStructureHandlerInterface $directoryStructureHandler
     */
    public function __construct(
        ImageDownloaderConfig $config,
        TxtReaderInterface $textReader,
        ImageDownloaderServiceInterface $imageDownloaderService,
        DirectoryStructureHandlerInterface $directoryStructureHandler
    ) {
        $this->getConfig = $config;
        $this->imageUrls = $textReader->readTxtFile();
        $this->imageDownloaderService = $imageDownloaderService;
        $this->directoryStructureHandler = $directoryStructureHandler;
    }



    public function downloadImages()
    {
        if (empty($this->imageUrls)){
            // todo return valid exception here
            return null;
        }

        $directoryName = $this->directoryStructureHandler->createDirectory();
        $batchSize = $this->getConfig->getImageDownloadBatchSize();

        $numberOfProcesses = count(
            array_chunk(
                $this->imageUrls,
                $this->getConfig->getImageDownloadBatchSize()
            ));


        for ($i =0; $i < $numberOfProcesses ; $i++) {
            $nextBatch = array_splice($this->imageUrls, 0, $batchSize);
            $this->imageUrls = array_values($this->imageUrls);
            $this->imageDownloaderService->downloadImages($nextBatch, $directoryName);
        }
    }



}