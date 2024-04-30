<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('list all products', function () {
    $this->withHeaders([
        'X-Custom-API-Key' => 'bgLs9mIGmzR3EUlhitoNdaDygaxUukbr5fnMMCp4q2srqHtwKL5EjAXU46qmdKnn',
    ]);
    Product::factory()->count(3)->create();

    $response = $this->get('/api/v1/products');

    expect($response->status())->toBe(200);
    expect($response['data'])->toHaveCount(3);

});

it('show a product', function () {
    $this->withHeaders([
        'X-Custom-API-Key' => 'bgLs9mIGmzR3EUlhitoNdaDygaxUukbr5fnMMCp4q2srqHtwKL5EjAXU46qmdKnn',
    ]);
    $product = Product::factory()->create();

    $response = $this->get('/api/v1/products/'.$product->id);

    expect($response->status())->toBe(200);
    expect($response['data']['id'])->toBe($product->id);
});

it('update a product', function () {
    $this->withHeaders([
        'X-Custom-API-Key' => 'bgLs9mIGmzR3EUlhitoNdaDygaxUukbr5fnMMCp4q2srqHtwKL5EjAXU46qmdKnn',
    ]);
    $product = Product::factory()->create();

    $response = $this->put('/api/v1/products/'.$product->id, [
        'product_name' => 'Product 1',
    ]);

    expect($response->status())->toBe(200);
    expect($response['product_name'])->toBe('Product 1');
});
