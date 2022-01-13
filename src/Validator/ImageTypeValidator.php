<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Validator;


use FisayoAfolayan\GetSafeBatchImageDownloader\config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\Reader\TxtReaderInterface;

class ImageTypeValidator implements ImageTypeValidatorInterface
{
    private ImageDownloaderConfig $getConfig;

    /**
     * @param ImageDownloaderConfig $config
     */
    public function __construct(ImageDownloaderConfig $config) {
        $this->getConfig = $config;
    }

    public function validate(Array $imagesUrl)
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

            if (!$this->isImage($imageUrl)) {
                unset($imagesUrl[$key]);
            }

        }
        return $imagesUrl;
    }

    /**
     * @param string $imageUrl
     *
     * @return mixed|string
     */
    protected function getUrlExtension(string $imageUrl)
    {
        $url_path_info = pathinfo($imageUrl);
        if (!empty($url_path_info['extension'])) {
            return $url_path_info['extension'];
        }
        return '';
    }

    /**
     * @param $imageUrl
     *
     * @return bool
     */
    protected function isImage($imageUrl): bool
    {
        $imageExtension = $this->getUrlExtension($imageUrl);
        if (in_array($imageExtension,  $this->getConfig->getAllowedImageExtensionTypes(), true)) {
            return true;
        }
        return false;
    }
}