<?php

namespace Sitemap\Formatters;

use Sitemap\Formatters\Interfaces\FileTypesInterface;
use Sitemap\Exeptions\InvalidDataException;


class Json implements FileTypesInterface
{
    public function make(array $pages)
    {
        return $this->convertArrayToJson($pages);
    }

    private function convertArrayToJson(array $pages)
    {
        $jsonString = json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if ($jsonString === false) {
            throw new InvalidDataException(json_last_error_msg());
        }

        return $jsonString;
    }
}
