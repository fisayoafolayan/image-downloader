<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\config;


use ArrayObject;
use FisayoAfolayan\GetSafeBatchImageDownloader\ImageDownloaderConstants\ImageDownloaderConstants;

class ImageDownloaderConfig
{
    /*
     * @var \ArrayObject| null
     */
    protected static $config = null;


    /**
     * @return mixed|null
     */
    public function getImageImportPath()
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_IMPORT_PATH,
            '/src/data/import/CSV/aww_dataset_short.txt'
        );
    }

    /**
     * @return mixed|null
     */
    public function getImageDownloadPath()
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_DOWNLOAD_PATH,
            '/src/data/downloads/'
        );
    }

    /**
     * @return mixed|null
     */
    public function getImageCountPerDownload()
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_COUNT_PER_DOWNLOAD,
            2
        );
    }

    /**
     * @return mixed|null
     */
    public function getAllowedImageExtensionTypes()
    {
        return self::get(
            ImageDownloaderConstants::IMAGE_EXTENSION_TYPES,
            []
        );
    }

    /**
     * @param $key
     * @param null $default
     *
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        if (empty(static::$config)) {
            $config = new ArrayObject();
            $config = static::buildConfig($config);
            static::$config = $config;
        }

        if (!static::hasValue($key) && $default !== null) {

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