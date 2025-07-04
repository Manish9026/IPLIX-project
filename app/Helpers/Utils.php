<?php
// app/Helpers/HeroHelper.php

namespace App\Helpers;

class Utils
{
    
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
}
