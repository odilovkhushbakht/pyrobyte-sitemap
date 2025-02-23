<?php

namespace Sitemap\Repositories;

use Sitemap\Exceptions\FileWriteException;
use Sitemap\Interfaces\RepositoryInterface;


class DocumentRepository implements RepositoryInterface
{
    function __construct(
        private string $filePath,
        private string $content,
    ) {}

    public function save()
    {
        if (file_put_contents($this->filePath, $this->content) === false) {
            throw new FileWriteException("Failed to write file: $this->filePath");
        }
    }
}
