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
    private TxtReaderInterface $textReader;
    private ImageTypeValidatorInterface $imageTypeValidator;
    private ClientInterface $client;


    /**
     * ImageDownloadAdapter constructor.
     * @param TxtReaderInterface $textReader
     * @param ImageTypeValidatorInterface $imageTypeValidator
     * @param ClientInterface $client
     */
    public function __construct(
        TxtReaderInterface $textReader,
        ImageTypeValidatorInterface $imageTypeValidator,
        ClientInterface $client
    ) {
        $this->textReader = $textReader;
        $this->imageTypeValidator = $imageTypeValidator;
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function downloadImages(): string
    {
        $imagesUrl = $this->textReader->readTxtFile();
        $validatedUrls = $this->imageTypeValidator->validate($imagesUrl);
        $downloadImages = $this->client->downloadImages($validatedUrls);

        return '';
    }



}