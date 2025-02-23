<?php

namespace Sitemap\Formatters;

use Sitemap\Formatters\Interfaces\FileTypesFactoryInterface;
use Sitemap\Enums\FileTypesEnum;
use Sitemap\Formatters\Csv;
use Sitemap\Formatters\Json;
use Sitemap\Formatters\Xml;


class FileTypesFactory implements FileTypesFactoryInterface
{
    public function make(string $type) 
    {
        return match ($type) {
            FileTypesEnum::CSV->value => new Csv(),
            FileTypesEnum::JSON->value => new Json(),
            FileTypesEnum::XML->value => new Xml(),
        };
    }
}