<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Reader;

interface TxtReaderInterface
{
    /**
     * @return array
     */
    public function readTxtFile(): array;

}