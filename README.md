Documentation 

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
What things you need to install the software.

- Git.
- PHP(^7.4).
- Composer.

## Install
Clone the git repository on your computer
```
$ git clone https://github.com/fisayoafolayan/image-downloader.git
```
You can also download the entire repository as a zip file and unpack on your computer.

After cloning the application, you need to install its dependencies.
```
$ cd image-downloader
$ composer install
```

## Project Directory Structure
```
- Project/
    - data/
        - downloads/
        - import/
    - src/
        - Client/
        - Config/
        - Constants/
        - Controller/
        - DirectoryHandler/
        - Reader/
        - Service/
        - Validator/
    - tests/
        - Unit/
            - downloads/
            - import/
    - vendor/
```
# Implementations
  - Image extensions:
      - image extensions allowed - "jpg, jpeg, png"
      - extension types can be configured in the config_default.php file
        ```
        $config[ImageDownloaderConstants::IMAGE_EXTENSION_TYPES] = [
            'jpg',
            'jpeg',
            'png'
            ];
        ```
  - Text File location:
    - Text file is saved on the server
    - Location of the text file can be changed from the config_default.php file
      ```
      $config[ImageDownloaderConstants::IMAGE_IMPORT_PATH] =
            APPLICATION_ROOT_DIR . '/data/import/aww_dataset.txt';
      ```
    - Images download location can be adjusted in the config_default file
      ```
      $config[ImageDownloaderConstants::IMAGE_DOWNLOAD_PATH] = 
            APPLICATION_ROOT_DIR . '/data/downloads';
      ```
    - Batch size can be configured in the config_default.php file
      ```
      $config[ImageDownloaderConstants::IMAGE_DOWNLOAD_BATCH_SIZE] = 10;
      ```
  - To execute script:
    ```
    $ php index.php
    ``` 

- To execute test:
  ```
  $ ./vendor/bin/phpunit ./tests/Unit/
  ``` 