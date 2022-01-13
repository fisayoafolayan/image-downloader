<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Validator;


use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;

class ImageTypeValidator implements ImageTypeValidatorInterface
{
    private ImageDownloaderConfig $getConfig;
    private const KEY_EXTENSION = 'extension';

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config)
    {
        $this->getConfig = $config;
    }

    /**
     * @param array $imagesUrl
     *
     * @return array
     */
    public function validate(Array $imagesUrl): array
    {
        return $this->sanitizeUrl($imagesUrl);

    }

    /**
     * @param array $imagesUrl
     *
     * @return array
     */
    protected function sanitizeUrl(array $imagesUrl): array
    {
        foreach ($imagesUrl as $key => $imageUrl) {
            $imageUrl = preg_replace("/\s+/", "", $imageUrl);

            if (parse_url($imageUrl, PHP_URL_SCHEME) === null) {
                unset($imagesUrl[$key]);
            }

            if (!$this->isValidImageUrl($imageUrl)) {
                unset($imagesUrl[$key]);
            }

        }
        return array_values($imagesUrl);
    }

    /**
     * @param $imageUrl
     *
     * @return bool
     */
    protected function isValidImageUrl($imageUrl): bool
    {
        $imageExtension = $this->getUrlExtension($imageUrl);
        if (
            in_array(
                $imageExtension,
                $this->getConfig->getAllowedImageExtensionTypes(),
            true)
        ) {
            return true;
        }
        return false;
    }

    /**
     * @param string $imageUrl
     *
     * @return string
     */
    protected function getUrlExtension(string $imageUrl): string
    {
        $url_path_info = pathinfo($imageUrl);
        if (!empty($url_path_info[self::KEY_EXTENSION])) {
            return $url_path_info[self::KEY_EXTENSION];
        }
        return '';
    }
}