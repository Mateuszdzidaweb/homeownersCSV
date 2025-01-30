<?php

namespace App\Services;

class CsvImportService
{
    /**
     * @throws \Exception
     */
    public function readCvs(string $filePath): array
    {

        $rows = [];

        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $rows[] = implode(',', $row);
            }
            fclose($handle);
        }

        return $rows;
    }
}
