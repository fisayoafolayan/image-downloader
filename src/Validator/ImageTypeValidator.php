<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Validator;


use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;

class ImageTypeValidator implements ImageTypeValidatorInterface
{
    private ImageDownloaderConfig $getConfig;
    private const KEY_EXTENSION = 'extension';

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config) {
        $this->getConfig = $config;
    }

    /**
     * @param array $imagesUrl
     *
     * @return array
     */
    public function validate(Array $imagesUrl): array
    {
        return $this->filterUrl($imagesUrl);

    }

    /**
     * @param array $imagesUrl
     *
     * @return array
     */
    protected function filterUrl(array $imagesUrl): array
    {
        foreach ($imagesUrl as $key => $imageUrl) {
            $imageUrl = preg_replace("/\s+/", "", $imageUrl);

            if (parse_url($imageUrl, PHP_URL_SCHEME) === NULL) {
                unset($imagesUrl[$key]);
            }

            if (!$this->isValidImageUrl($imageUrl)) {
                unset($imagesUrl[$key]);
            }

        }
        return $imagesUrl;
    }

    /**
     * @param $imageUrl
     *
     * @return bool
     */
    protected function isValidImageUrl($imageUrl): bool
    {
        $imageExtension = $this->getUrlExtension($imageUrl);
        if (in_array($imageExtension,  $this->getConfig->getAllowedImageExtensionTypes(), true)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $imageUrl
     *
     * @return mixed|string
     */
    protected function getUrlExtension(string $imageUrl)
    {
        $url_path_info = pathinfo($imageUrl);
        if (!empty($url_path_info[self::KEY_EXTENSION])) {
            return $url_path_info[self::KEY_EXTENSION];
        }
        return '';
    }
}