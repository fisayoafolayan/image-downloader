<?php

namespace FisayoAfolayan\ImageDownloader\Validator;

interface ImageTypeValidatorInterface
{
    /**
     * @param array $imagesUrl
     *
     * @return array
     */
    public function validate(Array $imagesUrl): array;

}