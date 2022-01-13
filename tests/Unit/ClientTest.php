<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Tests\Unit;

use FisayoAfolayan\GetSafeBatchImageDownloader\Client\Client;
use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderFactory;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
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

    public function testSuccessfulImageDownload(): void
    {
        $factory = new ImageDownloaderFactory();

        $directoryHandler = $factory->createDirectoryStructureHandler();
        $config = $factory->getConfig();

        $mockClient = $this->getMockBuilder(Client::class)
            ->onlyMethods(['createCurlCall'])
            ->setConstructorArgs([$config, $directoryHandler])
            ->getMock();

        $mockClient
            ->method('createCurlCall')
            ->willReturn(200);

        $mockClient->downloadImages($this->buildValidImageUrlsArray(), $config->getImageDownloadPath().'01-13-2022_17:01:01');
        $this->markTestSkipped('Can be improved');


    }

    public function buildValidImageUrlsArray(): array
    {
        return [
            "https://i.redd.it/ymqu6rog3xz41.png",
            "https://i.redd.it/6s20w4wcvlz41.jpg",
            "https://i.redd.it/2brdaztc8zv41.jpg"
        ];
    }

}