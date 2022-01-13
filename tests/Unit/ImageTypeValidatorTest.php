<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Tests\Unit;


use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderFactory;
use PHPUnit\Framework\TestCase;

class ImageTypeValidatorTest extends TestCase
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

    public function testImageTypeValidationOnInvalidImageUrls(): void
    {
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createImageTypeValidator();
        $imagesUrlArray = $handler->validate($this->buildInvalidImageUrlsArray());

        $this->assertCount(0, $imagesUrlArray);

    }

    public function testImageTypeValidationOnValidImageUrls(): void
    {
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createImageTypeValidator();
        $imagesUrlArray = $handler->validate($this->buildValidImageUrlsArray());

        $this->assertCount(3, $imagesUrlArray);

    }

    public function testImageTypeValidationImageUrls(): void
    {
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createImageTypeValidator();
        $imagesUrlArray = $handler->validate($this->buildImageUrlsArray());

        $this->assertCount(3, $imagesUrlArray);

    }

    public function buildInvalidImageUrlsArray(): array
    {
        return [
            "https://i.redd.it/4jjaxrrs",
            "xuv41.jpg",
            "https://i.redd.it/v57m2x0xix051"
        ];
    }

    public function buildValidImageUrlsArray(): array
    {
        return [
            "https://i.redd.it/ymqu6rog3xz41.png",
            "https://i.redd.it/6s20w4wcvlz41.jpg",
            "https://i.redd.it/2brdaztc8zv41.jpg"
        ];
    }

    public function buildImageUrlsArray(): array
    {
        return [
            "https://i.redd.it/4jjaxrrs",
            "xuv41.jpg",
            "https://i.redd.it/v57m2x0xix051",
            "https://i.redd.it/ymqu6rog3xz41.png",
            "https://i.redd.it/6s20w4wcvlz41.jpg",
            "https://i.redd.it/2brdaztc8zv41.jpg"
        ];
    }

}