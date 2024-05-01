<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {

    }

    public function allPaginated()
    {
        return $this->productRepository->allPaginated();
    }

    public function findById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function update($product, $data)
    {
        return $this->productRepository->update($product, $data);
    }

    public function delete($product)
    {
        return $this->productRepository->delete($product);
    }

    public function search($query)
    {
        return $this->productRepository->search($query);
    }
}
