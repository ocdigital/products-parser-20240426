<?php

namespace App\Services;

class FilesDataDownloader
{
    public function getFiles(){
        $indexUrl = 'https://challenges.coode.sh/food/data/json/index.txt';
        $index = file_get_contents($indexUrl);
        $files = explode("\n", $index);
        $files = array_filter($files);

        return $files;
    }

    public function downloadFile($file){
        $fileUrl = 'https://challenges.coode.sh/food/data/json/'.$file;
        $unzipedData = gzopen($fileUrl, "r");   
        $itemsJson = '';
        $itemsCount = 0;
    
        while (!gzeof($unzipedData) && $itemsCount < 100) {
            $chunk = gzread($unzipedData, 2048);    
            $itemsJson .= $chunk;
            $newItemsCount = substr_count($chunk, "\n");
            $itemsCount += $newItemsCount;
        }   

        gzclose($unzipedData);

        $itemsArray = explode("\n", $itemsJson);
        $first100Items = array_slice($itemsArray, 0, 100);

        $itemsJson = array_map('json_decode', $first100Items);   
        
        return $itemsJson;  
    }
}