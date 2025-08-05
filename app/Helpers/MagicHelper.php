<?php

namespace App\Helpers;

use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Storage;

class MagicHelper
{
    public static function schoolProfile(): SchoolProfile|null
    {
        return SchoolProfile::first();
    }

    public static function limit(int $number, string $grouper = 'dozens'): string
    {
        (array) $availableGrouper = ['dozens', 'hundreds', 'thousands'];

        if (!in_array($grouper, $availableGrouper)) {
            throw new \InvalidArgumentException("{$grouper} tidak tersedia. Kelompok yang tersedia: " . implode(', ', $availableGrouper));
        }

        $isLimit = false;

        if ($grouper == 'dozens')
            if ($number > 99) {
                $isLimit = true;
                $number = 99;
            }

        if ($grouper == 'dozens')
            if ($number > 999) {
                $isLimit = true;
                $number = 999;
            }

        if ($grouper == 'thousands')
            if ($number > 9990) {
                $isLimit = true;
                $number = 9999;
            }

        return number_format($number, 0, ',', '.') . ($isLimit ? '+' : '');
    }

    public static function download(string $path, string $filename)
    {
        if ($filename)
            return Storage::disk('public')
                ->download(
                    str_replace('storage/', '', $path),
                    $filename
                );

        return Storage::disk('public')
            ->download(
                str_replace('storage/', '', $path)
            );
    }

    public static function delete(string $path): bool|string
    {
        try {
            $realPath = str_replace('storage/', '', $path);
            if (Storage::disk('public')->exists($realPath)) {
                if (Storage::disk('public')
                    ->delete($realPath)
                ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return __('Unable to find file path.');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function convertYoutubeToEmbed($url): string|null
    {
        // Parse URL
        $parsedUrl = parse_url($url);

        // Ambil query string (v dan list)
        parse_str($parsedUrl['query'] ?? '', $query);

        $videoId = $query['v'] ?? null;
        $listId = $query['list'] ?? null;
        $startRadio = $query['start_radio'] ?? null;

        if (!$videoId) {
            return null; // URL tidak valid
        }

        $embedUrl = "https://www.youtube.com/embed/{$videoId}";

        // Tambahkan parameter playlist kalau ada
        $params = [];
        if ($listId) {
            $params[] = "list={$listId}";
        }
        if ($startRadio) {
            $params[] = "start_radio={$startRadio}";
        }

        if (count($params)) {
            $embedUrl .= '?' . implode('&', $params);
        }

        return $embedUrl;
    }
}
