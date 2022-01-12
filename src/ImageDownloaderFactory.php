<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader;


use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\CsvReader;

class ImageDownloaderFactory
{
    public function createCSVReader()
    {
        return new CsvReader();

    }

}