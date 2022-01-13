<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Tests\Unit;


use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderFactory;
use PHPUnit\Framework\TestCase;

class DirectoryDownloadHandlerTest extends TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        if (!defined('APPLICATION_ROOT_DIR')) {
            define('APPLICATION_ROOT_DIR', realpath(__DIR__));
        }
    }

    public function testDirectoryIsCreated(): void
    {
        $config = new ImageDownloaderConfig();
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createDirectoryStructureHandler();
        $directory = $handler->createDirectory();

        $this->assertDirectoryExists($config->getImageDownloadPath().$directory, 'Directory does not exist');

    }
}