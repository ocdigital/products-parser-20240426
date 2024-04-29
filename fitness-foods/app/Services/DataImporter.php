<?php

namespace App\Services;

use App\Models\Product;

class DataImporter
{
    public function importData($products)
    {

        foreach ($products as $product) {

            $product->code = trim($product->code, '"') ?? random_int(100000000, 999999999);
            $product->status = $product->status ?? 'draft';
            $product->imported_t = $product->imported_t ?? now();
            $product->url = $product->url ?? null;
            $product->creator = $product->creator ?? null;
            $product->created_t = $product->created_t ?? null;
            $product->last_modified_t = $product->last_modified_t ?? null;
            $product->product_name = $product->product_name ?? null;
            $product->quantity = $product->quantity ?? 0;
            $product->brands = $product->brands ?? null;
            $product->categories = $product->categories ?? null;
            $product->labels = $product->labels ?? null;
            $product->cities = $product->cities ?? null;
            $product->purchase_places = $product->purchase_places ?? null;
            $product->stores = $product->stores ?? null;
            $product->ingredients_text = $product->ingredients_text ?? null;
            $product->traces = $product->traces ?? null;
            $product->serving_size = $product->serving_size ?? null;
            $product->serving_quantity = is_numeric($product->serving_quantity) ?? 0;
            $product->nutriscore_score = is_numeric($product->nutriscore_score) ?? 0;
            $product->nutriscore_grade = $product->nutriscore_grade ?? null;
            $product->main_category = $product->main_category ?? null;
            $product->image_url = $product->image_url ?? null;
            $product->created_at = now();
            $product->updated_at = now();

            Product::create((array) $product);
        }
    }
}
