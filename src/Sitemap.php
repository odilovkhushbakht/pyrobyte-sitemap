<?php

namespace Sitemap;

use Sitemap\Interfaces\SitemapInterface;
use Sitemap\Formatters\Interfaces\FileTypesInterface;
use Sitemap\Interfaces\ValidationInterface;
use Sitemap\Repositories\DocumentRepository;
use Sitemap\Validations\Validation;


class Sitemap implements SitemapInterface
{
    public function __construct(
        private array $pages,
        private FileTypesInterface $typeOfFile,
        private string $filePath,
    ) {
        $this->pages = $pages;
        $this->typeOfFile = $typeOfFile;
        $this->filePath = $filePath;
        $this->generate();
    }

    public function generate()
    {
        $this->validatePages(new Validation());

        $content = $this->typeOfFile->make($this->pages);

        (new Directory($this->filePath))->create();

        (new DocumentRepository($this->filePath, $content))->save();

        return true;
    }

    private function validatePages(ValidationInterface $validation)
    {
        $validation->validate($this->pages);
    }
}
