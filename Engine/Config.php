<?php

namespace Engine;

class Config {
    const CONFIG_PATH = __DIR__ . '/../config.json';

    public static function check(): bool
    {
        if (!file_exists(self::CONFIG_PATH)) {
            return false;
        }
        return true;
    }

    public static function read(): array
    {
        $content = file_get_contents(self::CONFIG_PATH);
        return json_decode($content, true);
    }

    public static function process($format, $data): void
    {
        $finalData = [];
        foreach ($format as $k => $f) {
            $finalData[$data[$k]] = $f;
        }
        file_put_contents(self::CONFIG_PATH, json_encode($finalData));
    }

    public static function reconfigure(): void
    {
        FileManager::delete(self::CONFIG_PATH);
    }
}