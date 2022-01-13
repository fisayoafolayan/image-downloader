<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Client;

interface ClientInterface
{
    /**
     * @param array $imageUrls
     * @param string $directoryName
     */
    public function downloadImages(array $imageUrls, string $directoryName): void;

}