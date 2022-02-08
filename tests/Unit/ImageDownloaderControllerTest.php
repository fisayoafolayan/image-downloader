<?php

namespace FisayoAfolayan\ImageDownloader\Tests\Unit;


use FisayoAfolayan\ImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\ImageDownloader\Controller\ImageDownloadController;
use FisayoAfolayan\ImageDownloader\ImageDownloaderFactory;
use FisayoAfolayan\ImageDownloader\Service\ImageDownloaderService;
use PHPUnit\Framework\TestCase;

class ImageDownloaderControllerTest extends TestCase
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

    public function testDownladerServiceCall()
    {
        $factory = new ImageDownloaderFactory();

        $config =  new ImageDownloaderConfig();
        $directoryStructureHandler = $factory->createDirectoryStructureHandler();
        $imageValidator = $factory->createImageTypeValidator();
        $client = $factory->createClient();
        $txtReader = $factory->createTXTReader();

        $mockImageDownloaderServiceMock = $this->getMockBuilder(ImageDownloaderService::class)
            ->onlyMethods(['downloadImages'])
            ->setConstructorArgs([
                $imageValidator,
                $client
            ])
            ->getMock();

        $imageDownloaderController = new ImageDownloadController(
            $config,
            $txtReader,
            $mockImageDownloaderServiceMock,
            $directoryStructureHandler
        );

        $mockImageDownloaderServiceMock->expects($this->exactly(6))
            ->method('downloadImages');

        $imageDownloaderController->downloadImages();
    }

}