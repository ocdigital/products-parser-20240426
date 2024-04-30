<?php

namespace App\Services;

use App\Models\ImportHistory;
use App\Models\Product;

class DataImporter
{
    public function importData($products)
    {
        $startTime = microtime(true);
        $totalRecords = count($products);

        foreach ($products as $product) {
            try {
                $productData = [
                    'code' => trim($product->code, '"') ?? random_int(100000000, 999999999),
                    'status' => $product->status ?? 'draft',
                    'imported_t' => $product->imported_t ?? now(),
                    'url' => $product->url ?? null,
                    'creator' => $product->creator ?? null,
                    'created_t' => $product->created_t ?? null,
                    'last_modified_t' => $product->last_modified_t ?? null,
                    'product_name' => $product->product_name ?? null,
                    'quantity' => $product->quantity ?? 0,
                    'brands' => $product->brands ?? null,
                    'categories' => $product->categories ?? null,
                    'labels' => $product->labels ?? null,
                    'cities' => $product->cities ?? null,
                    'purchase_places' => $product->purchase_places ?? null,
                    'stores' => $product->stores ?? null,
                    'ingredients_text' => $product->ingredients_text ?? null,
                    'traces' => $product->traces ?? null,
                    'serving_size' => $product->serving_size ?? null,
                    'serving_quantity' => is_numeric($product->serving_quantity) ? $product->serving_quantity : 0,
                    'nutriscore_score' => is_numeric($product->nutriscore_score) ? $product->nutriscore_score : 0,
                    'nutriscore_grade' => $product->nutriscore_grade ?? null,
                    'main_category' => $product->main_category ?? null,
                    'image_url' => $product->image_url ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                Product::create($productData);
            } catch (\Throwable $exception) {
                \Sentry\captureException($exception);
            }
        }

        $timeToImport = round(microtime(true) - $startTime, 2);
    
        $importHistory = [
            'file_name' => $products['file_name'] ?? 'unknown',
            'imported_t' => now(),
            'total_records' => $totalRecords - 1,
            'time_to_import' => $timeToImport,
        ];

        ImportHistory::create($importHistory);
    }
}
