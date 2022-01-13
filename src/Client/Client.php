<?php

namespace FisayoAfolayan\GetSafeBatchImageDownloader\Client;


use FisayoAfolayan\GetSafeBatchImageDownloader\Config\ImageDownloaderConfig;
use FisayoAfolayan\GetSafeBatchImageDownloader\DirectoryHandler\DirectoryStructureHandlerInterface;

class Client implements ClientInterface
{
    private ImageDownloaderConfig $getConfig;
    private DirectoryStructureHandlerInterface $directoryStructureHandler;

    /**
     * @param ImageDownloaderConfig $config
     * @param DirectoryStructureHandlerInterface $directoryStructureHandler
     */
    public function __construct(
        ImageDownloaderConfig $config,
        DirectoryStructureHandlerInterface $directoryStructureHandler
    ) {
        $this->getConfig = $config;
        $this->directoryStructureHandler = $directoryStructureHandler;
    }

    /**
     * @param array $imageUrls
     */
    public function downloadImages(array $imageUrls, string $directoryName): void
    {
        foreach ($imageUrls as $imageUrl) {
            $filename = basename($imageUrl);
            $filePath = $this->getConfig->getImageDownloadPath(). '/' . $directoryName . '/' . $filename;

            if ($this->directoryStructureHandler->checkIfFileExist($directoryName . '/' . $filename)) {
                continue;
            }
            $this->createCurlCall($imageUrl, $filePath);
        }
    }

    /**
     * @param $imageUrl
     * @param string $filePath
     */
    protected function createCurlCall($imageUrl, string $filePath): void
    {
        try {
            // TODO Create logger to log successful download path

            $ch = curl_init($imageUrl);
            $fp = fopen($filePath, 'w');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}