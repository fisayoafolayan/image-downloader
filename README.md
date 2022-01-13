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
        
    
# Why is this a good  solution?
 - The implementation follows the OOP and SOLID guidelines. 
 - Factory and Facade Design patterns were used. 
 - Dependency Injections is also used.
 - A robust config file is used
 - TxtReader is used to read the .txt file where the urls are stored and returns an array of the urls
 - From the controller, a service is injected to validate the urls after which it is passed to the client responsible for downloading images
 - Validator method sanitizes the urls, and returns valid urls
 - In the controller, batches are implemented based on the configuration in the config_default file/
 - Because factory design pattern is used, every part of the system can be substituted or extended with new classes
 - Curl is used as the client of choice, with its implementation, the client can be substituted for a new client, and the download functionality will work as expected
 - The modularity of the implementation, makes it efficient for production and further development with other developers
 - The namespace and folder directory, are generic enough to accommodate new features




# Further Improvement
- Cache File names before saving image
- Improve Exception handling
- Improve test cases
- Import file can be included in the terminal 