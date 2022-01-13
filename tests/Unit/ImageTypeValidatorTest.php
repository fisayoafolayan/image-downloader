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

    /**
     * @dataProvider dataProviderForTest
     */
    public function testImageTypeValidationOnImageUrls($expectedResult, $input): void
    {
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createImageTypeValidator();
        $imagesUrlArray = $handler->validate($input);

        $this->assertSame($expectedResult, $imagesUrlArray);

    }

    public function dataProviderForTest()
    {
        return [
            [
                [],
                [
                    "https://i.redd.it/4jjaxrrs",
                    "xuv41.jpg",
                    "https://i.redd.it/v57m2x0xix051"
                ]
            ],
            [
                [
                    "https://i.redd.it/ymqu6rog3xz41.png",
                    "https://i.redd.it/6s20w4wcvlz41.jpg",
                    "https://i.redd.it/2brdaztc8zv41.jpg"
                ],
                [
                    "https://i.redd.it/ymqu6rog3xz41.png",
                    "https://i.redd.it/6s20w4wcvlz41.jpg",
                    "https://i.redd.it/2brdaztc8zv41.jpg"
                ],
            ],
            [
                [
                    "https://i.redd.it/ymqu6rog3xz41.png",
                    "https://i.redd.it/6s20w4wcvlz41.jpg",
                    "https://i.redd.it/2brdaztc8zv41.jpg"
                ],
                [
                    "https://i.redd.it/4jjaxrrs",
                    "xuv41.jpg",
                    "https://i.redd.it/v57m2x0xix051",
                    "https://i.redd.it/ymqu6rog3xz41.png",
                    "https://i.redd.it/6s20w4wcvlz41.jpg",
                    "https://i.redd.it/2brdaztc8zv41.jpg"
                ],
            ]
        ];
    }

}