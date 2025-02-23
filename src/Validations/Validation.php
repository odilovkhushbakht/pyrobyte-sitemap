<?php

namespace Sitemap\Validations;

use Sitemap\Enums\PageChangeFrequency;
use Sitemap\Exceptions\InvalidDataException;
use Sitemap\Interfaces\ValidationInterface;


class Validation implements ValidationInterface
{
    private $changefreq = [
        PageChangeFrequency::ALWAYS->value,
        PageChangeFrequency::HOURLY->value,
        PageChangeFrequency::DAILY->value,
        PageChangeFrequency::WEEKLY->value,
        PageChangeFrequency::MONTHLY->value,
        PageChangeFrequency::YEARLY->value,
        PageChangeFrequency::NEVER->value,
    ];

    public function validate(array $pages)
    {
        foreach ($pages as $page) {
            if (!isset($page['loc']) || !filter_var($page['loc'], FILTER_VALIDATE_URL)) {
                throw new InvalidDataException("Invalid URL in page data: " . ($page['loc'] ?? ''));
            }
            if (isset($page['lastmod']) && !strtotime($page['lastmod'])) {
                throw new InvalidDataException("Invalid lastmod in page data: " . ($page['lastmod'] ?? ''));
            }
            if (isset($page['priority']) && !is_numeric($page['priority'])) {
                throw new InvalidDataException("Invalid priority in page data: " . ($page['priority'] ?? ''));
            }
            if (isset($page['changefreq']) && !in_array($page['changefreq'], $this->changefreq)) {
                throw new InvalidDataException("Invalid changefreq in page data: " . ($page['changefreq'] ?? ''));
            }
        }
    }
}
