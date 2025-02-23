<?php

namespace Sitemap\Formatters;

use Sitemap\Formatters\Interfaces\FileTypesInterface;
use SimpleXMLElement;


class Xml implements FileTypesInterface
{
    private $xml;
    private string $xmlDoc = <<<END
    <urlset
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
     xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
     http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    </urlset>
    END;

    public function make(array $pages)
    {
        $this->createXml();
        $this->addElementsToXml($pages);
        return $this->convertXmlToStrings();
    }

    private function createXml()
    {
        $this->xml = new SimpleXMLElement($this->xmlDoc);
    }

    private function addElementsToXml(array $pages)
    {
        foreach ($pages as $page) {
            $url = $this->xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($page['loc']));
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }
    }

    private function convertXmlToStrings()
    {
        return $this->xml->asXML();
    }
}
