<?php
// app/Helpers/HeroHelper.php

namespace App\Helpers;

class Utils
{

    // file media utills like file uploader,path finder
    protected static string $baseDir = WRITEPATH . 'data/';

    public static function uploadMedia($file, $uploadDir = 'uploads/workMedia/', $maxSizeMB = 5, $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4'])
    {
        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            return ['error' => 'No file or upload error.'];
        }

        if ($file->getSize() > $maxSizeMB * 1024 * 1024) {
            return ['error' => 'File size exceeds ' . $maxSizeMB . 'MB'];
        }

        $mimeType = $file->getMimeType();
        if (!in_array($mimeType, $allowedTypes)) {
            return ['error' => 'Invalid file type: ' . $mimeType];
        }

        $originalName = $file->getClientName();
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
        $newFileName = time() . '_' . uniqid() . '_' . $safeName . '.' . $ext;

        $uploadPath = FCPATH . $uploadDir;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if (!$file->move($uploadPath, $newFileName)) {
            return ['error' => 'Failed to move file'];
        }

        return [
            'url' => ($uploadDir . $newFileName),
            'type' => $mimeType,
        ];
    }


    public static function deleteMedia($filePath)
    {
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath); // Returns true on success
        }
        return false;
    }



    public static function read(string $filename): array
    {
        $filePath = self::$baseDir . $filename;


        if (!file_exists($filePath)) {
            return [];
        }

        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON decode error in $filename: " . json_last_error_msg());
            return [];
        }

        return is_array($data) ? $data : [];
    }

    public static function write(string $filename, array $data): bool
    {
        $filePath = self::$baseDir . $filename;

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        if ($json === false) {
            log_message('error', "JSON encode error in $filename: " . json_last_error_msg());
            return false;
        }

        if (file_put_contents($filePath, $json) === false) {
            log_message('error', "Failed to write to file $filename");
            return false;
        }

        return true;
    }

    public static function getHeroData(string $section): array
    {
        $jsonPath = WRITEPATH . 'data/heroContent.json';

        if (!file_exists($jsonPath)) {
            return [
                'status' => false,
                'message' => 'Hero content file not found',
                'data' => []
            ];
        }

        $jsonRaw = file_get_contents($jsonPath);
        $data = json_decode($jsonRaw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => false,
                'message' => 'Invalid JSON format: ' . json_last_error_msg(),
                'data' => []
            ];
        }

        if (!isset($data[$section])) {
            return [
                'status' => false,
                'message' => "Section '{$section}' not found in hero content",
                'data' => []
            ];
        }

        $hero = $data[$section];

        // Validate structure
        $requiredKeys = ['id', 'title', 'gradientTitle', 'subTitle', 'description', 'btn'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $hero)) {
                return [
                    'status' => false,
                    'message' => "Missing key '{$key}' in section '{$section}'",
                    'data' => []
                ];
            }
        }

        // Validate btn array
        if (!is_array($hero['btn'])) {
            return [
                'status' => false,
                'message' => "The 'btn' field must be an array in '{$section}'",
                'data' => []
            ];
        }

        return [
            'status' => true,
            'message' => 'Hero data fetched successfully',
            'data' => $hero
        ];
    }
    public static function getRandomList(array $items, int $maxSize = 10, string $uniqueKey = 'title'): array
    {
        if (empty($items)) {
            return [['title' => 'Default Service']];
        }

        $count = count($items);
        $randomIndex = rand(0, $count - 1);
        $randomItem = $items[$randomIndex];

        // Insert random item at a different index
        do {
            $newIndex = rand(0, $count);
        } while ($newIndex === $randomIndex);

        $itemsCopy = $items;
        array_splice($itemsCopy, $newIndex, 0, [$randomItem]);

        // Remove duplicates based on the uniqueKey
        $uniqueItems = [];
        $seenKeys = [];

        foreach ($itemsCopy as $item) {
            $key = $item[$uniqueKey] ?? null;
            if ($key && !in_array($key, $seenKeys)) {
                $uniqueItems[] = $item;
                $seenKeys[] = $key;
            }
        }

        // Limit to max size
        return array_slice($uniqueItems, 0, $maxSize);
    }
    public static function getRandorColorSet(): array
    {
        $colors = [
            'red',
            'orange',
            'amber',
            'yellow',
            'lime',
            'green',
            'emerald',
            'teal',
            'cyan',
            'sky',
            'blue',
            'indigo',
            'violet',
            'purple',
            'fuchsia',
            'pink',
            'rose'
        ];

        $baseColor = $colors[array_rand($colors)];
        $altColor  = $colors[array_rand($colors)];

        return [
            'gradient'    => "from-{$baseColor}-400 to-{$altColor}-400",
            'accentColor' => "{$baseColor}-400",
            'tagColor'    => "{$baseColor}-300",
            'alterColor' => $altColor,
            'baseColor' => $baseColor
        ];
    }
    public static  function slugify($title)
    {
        return strtolower(str_replace(' ', '-', trim($title)));
    }
    public static function deslugify($slug)
    {
        return ucwords(str_replace('-', ' ', trim($slug)));
    }
}



class WorkService
{
    protected static $servicesFile = 'services.json';
    protected static $workFile = 'singleWork.json';

    public static function getMergedData()
    {
        $services = Utils::read(self::$servicesFile)['services'] ?? [];
        $works = Utils::read(self::$workFile);

        $projects = [];

        foreach ($services as $service) {
            $categoryId = (string) $service['id'];

            $matchedWorks = array_filter($works, fn($work) => (string)$work['catId'] === $categoryId);

            $mappedWorks = array_map(function ($work) {
                return [
                    "id" => $work['id'],
                    "title" => $work['title'],
                    "description" => $work['subTitles'] ?? '',
                    "image" => $work['cardMedia'][0]['url'] ?? '',
                    "tags" => $work['tags'],
                    // "link" => $work['link'],
                    "updated_at" => $work['updated_at'],
                    "media" => $work['cardMedia'],
                ];
            }, $matchedWorks);

            $projects[] = [
                "id" => $service['id'],
                "name" => $service['title'],
                "description" => $service['description'],
                "icon" => $service['icon'],
                "projectCount" => count($mappedWorks),
                "gradient" => $service['gradient'],
                "accentColor" => $service['accentColor'],
                "tagColor" => $service['tagColor'],
                "alterColor" => $service['alterColor'],
                "categoryId" => $service['id'],
                "projects" => array_values($mappedWorks),
                "created_at" => $service['created_at'],
                "updated_at" => $service['updated_at'],
                "isActive" => $service['isActive']
            ];
        }

        return $projects;
    }
    public static function getWorks(?string $title = null, ?string $search = null): array
{
    $workList = Utils::read(self::$workFile);
    if (empty($workList)) return [];

    // Filter by search term
    if (!empty($search)) {
        $searchPattern = '/' . preg_quote($search, '/') . '/i';
        $workList = array_filter($workList, function ($item) use ($searchPattern) {
            return (
                (isset($item['id']) && preg_match($searchPattern, $item['id'])) ||
                (isset($item['title']) && preg_match($searchPattern, $item['title'])) ||
                (isset($item['catTitle']) && preg_match($searchPattern, $item['catTitle']))
            );
        });
        $workList = array_values($workList);
    }

    // Filter by title if provided
    if (!empty($title)) {
        $searchPattern = '/' . preg_quote(Utils::deslugify($title), '/') . '/i';
        $workList = array_filter($workList, function ($item) use ($searchPattern) {
            return isset($item['title']) && preg_match($searchPattern, $item['title']);
        });
        $workList = array_values($workList);
    }

    return $workList;
}

}
