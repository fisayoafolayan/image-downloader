<?php

namespace FisayoAfolayan\ImageDownloader\Reader;

interface TxtReaderInterface
{
    /**
     * @return array
     */
    public function getImageUrlsFromTextFile(): array;

}