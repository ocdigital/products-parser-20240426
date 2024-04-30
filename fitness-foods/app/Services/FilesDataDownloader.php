<?php

namespace App\Services;

class FilesDataDownloader
{
    public function getFiles()
    {
        try {
            $indexUrl = 'https://challenges.coode.sh/food/data/json/index.txt';
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
            // Baixar o arquivo localmente
            $localFilePath = storage_path('app/'.$file);
            file_put_contents($localFilePath, fopen('https://challenges.coode.sh/food/data/json/'.$file, 'r'));
    
            // Abrir o arquivo descompactado
            $unzipedData = gzopen($localFilePath, 'r');
            $itemsJson = '';
            $itemsCount = 0;
            $maxItems = 100;
    
            // Definir o tamanho do buffer de leitura
            $bufferSize = 2048;
    
            // Ler o arquivo e contar os itens
            while (! gzeof($unzipedData) && $itemsCount < $maxItems) {
                $chunk = gzread($unzipedData, $bufferSize);
                $itemsJson .= $chunk;
                $newItemsCount = substr_count($chunk, "\n");
                $itemsCount += $newItemsCount;
            }
    
            // Fechar o arquivo
            gzclose($unzipedData);
    
            // Excluir o arquivo local após a leitura
            unlink($localFilePath);
    
            // Processar os dados extraídos
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
