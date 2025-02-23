<?php

namespace Sitemap;

use Sitemap\Exceptions\FileWriteException;
use Sitemap\Interfaces\DirectoryInterface;


class Directory implements DirectoryInterface
{
    function __construct(private $path) {}

    public function create()
    {
        $this->getFolderPath();
        $this->makeFolder();
    }

    private function getFolderPath()
    {
        $this->path = dirname($this->path);
    }

    private function makeFolder()
    {
        if (!is_dir($this->path)) {
            if (!mkdir($this->path, 0777, true)) {
                throw new FileWriteException("Failed to create directory: " . $this->path);
            }
        }
    }
}
