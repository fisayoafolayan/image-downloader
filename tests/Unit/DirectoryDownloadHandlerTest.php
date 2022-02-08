<?php

namespace FisayoAfolayan\ImageDownloader\Tests\Unit;


use FisayoAfolayan\ImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\ImageDownloader\ImageDownloaderFactory;
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