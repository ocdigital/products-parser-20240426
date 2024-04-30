<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
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
        $products = $this->productService->allPaginated($perPage);

        return new ProductCollection($products);
    }

    public function show($id)
    {
        $product = $this->productService->findById($id);
        if (! $product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        if (! $product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return $this->productService->update($product, $data);
    }

    public function destroy(Product $product)
    {
        if (! $product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $result = $this->productService->delete($product);
        if (! $result) {
            return response()->json(['message' => 'Error deleting product'], 500);
        }

        return response()->json(['message' => 'Product deleted'], 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = $this->productService->search($query);

        return new ProductCollection($products);
    }
}
