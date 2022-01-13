<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler;


interface DirectoryStructureHandlerInterface
{
    public function createDirectory(): string;

    public function checkIfFileExist(string $location): bool;

}