<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Client;


interface ClientInterface
{
    public function downloadImages(array $imageUrls);

}