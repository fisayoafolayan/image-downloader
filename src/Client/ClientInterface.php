<?php

namespace FisayoAfolayan\ImageDownloader\Client;

interface ClientInterface
{
    /**
     * @param array  $imageUrls
     * @param string $directoryName
     *
     * @return void
     */
    public function downloadImages(array $imageUrls, string $directoryName): void;

}