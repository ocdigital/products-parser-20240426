<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Services\ProductService;
use Tests\TestCase;

uses(TestCase::class);

it('list all products', function () {
    $mockService = mock(ProductService::class);
    $mockService->shouldReceive('allPaginated')
        ->once()
        ->andReturn(collect([
            new Product(['product_name' => 'Product 1']),
            new Product(['product_name' => 'Product 2']),
        ]));

    $controller = new ProductController($mockService);
    $result = $controller->index(request());

    expect($result)->toBeInstanceOf(\App\Http\Resources\ProductCollection::class);
    expect($result->count())->toBe(2);
    expect($result->first()->product_name)->toBe('Product 1');
    expect($result->last()->product_name)->toBe('Product 2');
});

it('show a product', function () {
    $mockProduct = Product::factory()->create(['product_name' => 'Product 1']);

    $mockService = mock(ProductService::class);
    $mockService->shouldReceive('findById')
        ->once()
        ->with($mockProduct->id)
        ->andReturn($mockProduct);

    $controller = new ProductController($mockService);
    $result = $controller->show($mockProduct->id);

    expect($result)->toBeInstanceOf(\App\Http\Resources\ProductResource::class);
    expect($result->product_name)->toBe('Product 1');
});

it('update a product', function () {
    $this->withHeaders([
        'X-Custom-API-Key' => 'bgLs9mIGmzR3EUlhitoNdaDygaxUukbr5fnMMCp4q2srqHtwKL5EjAXU46qmdKnn',
    ]);
    $product = Product::factory()->create();

    $response = $this->put('/api/v1/products/'.$product->id, [
        'product_name' => 'Product 1',
    ]);

    $updatedProduct = Product::find($product->id); // Buscar o produto atualizado do banco de dados

    expect($response->status())->toBe(200);
    expect($updatedProduct->product_name)->toBe('Product 1'); // Verificar se o nome do produto foi atualizado corretamente
});
