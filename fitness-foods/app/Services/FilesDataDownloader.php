<?php

namespace App\Services;

class FilesDataDownloader
{
    public function getFiles()
    {
        try {
            $indexUrl = env('OPEN_FOOD_FACTS_FILES_LIST_URL');
            $index = file_get_contents($indexUrl);
            $files = explode("\n", $index);
            $files = array_filter($files);

            return $files;
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
        }

    }

    public function getFileContent($file)
    {
        try {
            $localFilePath = storage_path('app/'.$file);
            file_put_contents($localFilePath,
                fopen(env('OPEN_FOOD_FACTS_FILE_URL').$file, 'r'));

            $unzipedData = gzopen($localFilePath, 'r');
            $itemsJson = '';
            $itemsCount = 0;
            $maxItems = env('QUANTITY_PRODUCTS_TO_IMPORT');
            $bufferSize = 2048;

            while (! gzeof($unzipedData) && $itemsCount < $maxItems) {
                $chunk = gzread($unzipedData, $bufferSize);
                $itemsJson .= $chunk;
                $newItemsCount = substr_count($chunk, "\n");
                $itemsCount += $newItemsCount;
            }

            gzclose($unzipedData);

            unlink($localFilePath);

            $itemsArray = explode("\n", $itemsJson);
            $first100Items = array_slice($itemsArray, 0, $maxItems);
            $itemsJson = array_map('json_decode', $first100Items);
            $itemsJson['file_name'] = str_replace('.json.gz', '', $file);

            return $itemsJson;
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
        }
    }
}
