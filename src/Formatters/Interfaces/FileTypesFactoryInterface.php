<?php

namespace Sitemap\Formatters\Interfaces;


interface FileTypesFactoryInterface
{
    public function make(string $type);
}
