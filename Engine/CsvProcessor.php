<?php

namespace Engine;

class CsvProcessor implements Processor
{
    const STORAGE_PATH = __DIR__ . '/../Storage';

    public static function read(string $filename): array
    {
        $row = 0;
        $dataCsv = [];
        $handle = fopen($filename, "r");

        if (!$handle) {
            return [];
        }


        while (($csvRes = fgetcsv($handle)) !== false) {
            $dataCsv[$row] = $csvRes;
            $row++;
        }
        fclose($handle);

        return $dataCsv;
    }

    public static function process(array $data): array
    {
        $config = Config::read();
        $newTemplate = [];

        foreach ($config as $k => $v) {
            foreach ($data[0] as $i => $dk) {
                if ($dk == $k) {
                    $newTemplate[$v] = $i;
                    break;
                }
            }
        }

        unset($data[0]);

        $finalData = [array_keys($newTemplate)];

        foreach ($data as $datum) {
            $tmpData = [];
            foreach ($newTemplate as $k) {
                $tmpData[] = $datum[$k];
            }
            $finalData[] = $tmpData;
        }

        return $finalData;
    }

    public static function save(array $data, string $name = null): string
    {
        if (empty($name)) {
            $name = rand(9999, 99999999);
        }

        if (substr($name, -4, 4) != '.csv') {
            $name .= ".csv";
        }

        if (!is_dir(self::STORAGE_PATH)) {
            mkdir(self::STORAGE_PATH);
        }

        $path = self::STORAGE_PATH . '/' . $name;

        $fp = fopen($path, 'w');

        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        return $path;
    }

}