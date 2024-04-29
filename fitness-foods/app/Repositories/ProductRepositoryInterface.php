<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function update(Product $product, array $data): Product;

    public function delete(Product $product): bool;

    public function findById($id): ?Product;

    public function allPaginated($perPage = 10): mixed;
    

}