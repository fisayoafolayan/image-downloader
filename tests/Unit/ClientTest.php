<?php

namespace FisayoAfolayan\ImageDownloader\Tests\Unit;

use FisayoAfolayan\ImageDownloader\Client\Client;
use FisayoAfolayan\ImageDownloader\ImageDownloaderFactory;
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

        $mockClient->expects($this->exactly(3))
            ->method('createCurlCall')
            ->willReturn(200);

        $directoryName = $directoryHandler->createDirectory();
        $mockClient->downloadImages(
            $this->buildValidImageUrlsArray(),
            $directoryName
        );
        $this->markTestSkipped('Can be improved');


    }

    public function buildValidImageUrlsArray(): array
    {
        return [
            "https://i.redd.it/ymqu6rog3xz41.png",
        ];
    }

}