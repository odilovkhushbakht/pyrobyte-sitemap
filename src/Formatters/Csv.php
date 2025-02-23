<?php

namespace Sitemap\Formatters;

use Sitemap\Formatters\Interfaces\FileTypesInterface;


class Csv implements FileTypesInterface
{
    private const ATTRIBUTES = ['loc', 'lastmod', 'priority', 'changefreq'];
    
    public function make(array $pages)
    {
        $output = fopen('php://temp', 'r+');
        fputcsv($output, self::ATTRIBUTES, ';');

        foreach ($pages as $page) {
            fputcsv($output, $page, ';');
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }
}