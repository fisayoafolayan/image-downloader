<?php

namespace FisayoAfolayan\ImageDownloader\DirectoryHandler;


interface DirectoryStructureHandlerInterface
{
    public function createDirectory(): string;

    public function checkIfFileExist(string $location): bool;

}