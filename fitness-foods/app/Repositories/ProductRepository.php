<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function findById($id): ?Product
    {
        return Product::withTrashed()->find($id);
    }

    public function allPaginated($perPage = 10): LengthAwarePaginator
    {
        return Product::withTrashed()->paginate($perPage);
    }
}