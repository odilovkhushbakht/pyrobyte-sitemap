# pyrobyte-task

Пример:

require '..\vendor\autoload.php';

use Sitemap\Sitemap;
use Sitemap\Enums\FileTypesEnum;
use Sitemap\Enums\PageChangeFrequency;
use Sitemap\Exceptions\InvalidDataException;
use Sitemap\Formatters\FileTypesFactory;


$pages = [
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-14',
        'priority' => 1,
        'changefreq' => PageChangeFrequency::HOURLY->value,
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-10',
        'priority' => 0.5,
        'changefreq' => PageChangeFrequency::DAILY->value,
    ],
    [
        'loc' => 'https://site.ru/category',
        'lastmod' => '2020-12-09',
        'priority' => 0.5,
        'changefreq' => PageChangeFrequency::DAILY->value,
    ],
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-14',
        'priority' => 1,
        'changefreq' => PageChangeFrequency::HOURLY->value,
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-10',
        'priority' => 0.5,
        'changefreq' => PageChangeFrequency::DAILY->value,
    ],
    [
        'loc' => 'https://site.ru/category',
        'lastmod' => '2020-12-09',
        'priority' => 0.5,
        'changefreq' => PageChangeFrequency::DAILY->value,
    ],
];


$filePath = '..\public\sitemap\sitemap.csv';

try {
    $generator = new Sitemap($pages, (new FileTypesFactory())->make(FileTypesEnum::CSV->value), $filePath);
    echo "Sitemap generated successfully!";
} catch (InvalidDataException $e) {
    echo "Error: " . $e->getMessage();
}


$filePath = '..\public\sitemap\sitemap.xml';

try {
    $generator = new Sitemap($pages, (new FileTypesFactory())->make(FileTypesEnum::XML->value), $filePath);
    echo "Sitemap generated successfully!";
} catch (InvalidDataException $e) {
    echo "Error: " . $e->getMessage();
}


$filePath = '..\public\sitemap\sitemap.json';

try {
    $generator = new Sitemap($pages, (new FileTypesFactory())->make(FileTypesEnum::JSON->value), $filePath);
    echo "Sitemap generated successfully!";
} catch (InvalidDataException $e) {
    echo "Error: " . $e->getMessage();
}