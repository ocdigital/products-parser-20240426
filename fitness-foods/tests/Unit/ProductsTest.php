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
    $mockService = mock(ProductService::class);
    $mockService->shouldReceive('findById')
        ->once()
        ->andReturn(new Product(['product_name' => 'Product 1']));

    $controller = new ProductController($mockService);
    $result = $controller->show(1);

    expect($result)->toBeInstanceOf(\App\Http\Resources\ProductResource::class);
    expect($result->product_name)->toBe('Product 1');
});

it('update a product', function () {
    $mockService = mock(ProductService::class);
    $mockService->shouldReceive('update')
        ->once()
        ->andReturn(new Product(['product_name' => 'Product 2']));

    $controller = new ProductController($mockService);
    $result = $controller->update(request(), new Product(['product_name' => 'Product 1']));

    expect($result)->toBeInstanceOf(\App\Models\Product::class);
    expect($result->product_name)->toBe('Product 2');
});
