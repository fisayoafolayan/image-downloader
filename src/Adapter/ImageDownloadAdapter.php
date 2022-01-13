<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Adapter;


use FisayoAfolayan\GetSafeBatchImageDownloader\Client\Client;
use FisayoAfolayan\GetSafeBatchImageDownloader\Client\ClientInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidator;
use FisayoAfolayan\GetSafeBatchImageDownloader\Validator\ImageTypeValidatorInterface;

class ImageDownloadAdapter implements ImageDownloadAdapterInterface
{
    private ImageDownloaderConfig $getConfig;
    private TxtReaderInterface $textReader;
    private ImageTypeValidatorInterface $imageTypeValidator;
    private ClientInterface $client;


    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(
        ImageDownloaderConfig $config,
        TxtReaderInterface $textReader,
        ImageTypeValidatorInterface $imageTypeValidator,
        ClientInterface $client
    ) {
        $this->getConfig = $config;
        $this->textReader = $textReader;
        $this->imageTypeValidator = $imageTypeValidator;
        $this->client = $client;
    }

    public function downloadImages()
    {
        $imagesUrl = $this->textReader->readTxtFile();
        $validatedUrls = $this->imageTypeValidator->validate($imagesUrl);
        $downloadImages = $this->client->downloadImages($validatedUrls);

        return '';
    }



}