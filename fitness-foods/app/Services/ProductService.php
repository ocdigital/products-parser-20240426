<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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
}