<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        return $this->productService->allPaginated($perPage);
    }

    public function show($id)
    {
        return $this->productService->findById($id);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        return $this->productService->update($product, $data);
    }

    public function destroy(Product $product)
    {
        return $this->productService->delete($product);
    }
}
