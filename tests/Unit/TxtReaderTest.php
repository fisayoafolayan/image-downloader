<?php

namespace FisayoAfolayan\ImageDownloader\Tests\Unit;

use FisayoAfolayan\ImageDownloader\ImageDownloaderFactory;
use PHPUnit\Framework\TestCase;

class TxtReaderTest extends TestCase
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

    public function testGetImageUrlsFromTextFile(): void
    {
        $factory = new ImageDownloaderFactory();
        $handler = $factory->createTXTReader();
        $imagesUrl = $handler->getImageUrlsFromTextFile();

        $this->assertIsArray($imagesUrl);

    }

}