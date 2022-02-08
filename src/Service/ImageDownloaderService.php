<?php

namespace FisayoAfolayan\ImageDownloader\Service;


use FisayoAfolayan\ImageDownloader\Client\ClientInterface;
use FisayoAfolayan\ImageDownloader\Validator\ImageTypeValidatorInterface;

class ImageDownloaderService implements ImageDownloaderServiceInterface
{
    private ImageTypeValidatorInterface $imageTypeValidator;
    private ClientInterface $client;

    /**
     * @param ImageTypeValidatorInterface $imageTypeValidator
     * @param ClientInterface             $client
     */
    public function __construct(
        ImageTypeValidatorInterface $imageTypeValidator,
        ClientInterface $client
    ) {
        $this->imageTypeValidator = $imageTypeValidator;
        $this->client = $client;
    }

    /**
     * @param array  $imagesUrl
     * @param string $directoryName
     */
    public function downloadImages(array $imagesUrl, string $directoryName): void
    {
        if ($imagesUrl) {
            $validatedUrls = $this->imageTypeValidator->validate($imagesUrl);
            $this->client->downloadImages($validatedUrls, $directoryName);
        }
    }

}