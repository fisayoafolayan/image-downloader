<?php

namespace FisayoAfolayan\ImageDownloader\Config;


use ArrayObject;
use FisayoAfolayan\ImageDownloader\Constants\ImageDownloaderConstants;

class ImageDownloaderConfig
{
    /*
     * @var \ArrayObject| null
     */
    protected static  $config = null;


    /**
     * @return mixed|null
     */
    public function getImageImportPath()
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_IMPORT_PATH,
            APPLICATION_ROOT_DIR.'/data/import/aww_dataset.txt'
        );
    }

    /**
     * @return string
     */
    public function getImageDownloadPath(): string
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_DOWNLOAD_PATH,
            APPLICATION_ROOT_DIR.'/data/downloads/'
        );
    }

    /**
     * @return integer
     */
    public function getImageDownloadBatchSize(): int
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_DOWNLOAD_BATCH_SIZE,
            2
        );
    }

    /**
     * @return array
     */
    public function getAllowedImageExtensionTypes(): array
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_EXTENSION_TYPES,
            ['jpg', 'jpeg', 'png']
        );
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public static function get(string $key, $default = null)
    {
        if (empty(static::$config)) {
            $config = new ArrayObject();
            $config = static::buildConfig($config);
            static::$config = $config;
        }

        if ($default !== null && !static::hasValue($key)) {
            return $default;
        }

        if (!static::hasValue($key)) {
            // TODO return exception
            return null;
        }
        return static::$config[$key];
    }

    /**
     * @param ArrayObject $config
     *
     * @return \ArrayObject
     */
    protected static function buildConfig(ArrayObject $config): ArrayObject
    {
        $fileName =  APPLICATION_ROOT_DIR.'/config_default.php';
        if (file_exists($fileName)) {
            include $fileName;
        }

        return $config;

    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public static function hasValue(string $key): bool
    {
        return isset(static::$config[$key]);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public static function hasKey(string $key): bool
    {
        return array_key_exists($key, static::$config);
    }

}