<?php

use Illuminate\Support\Facades\Log;

it('should return the API info', function () {
    $this->withHeaders([
        'X-Custom-API-Key' => 'bgLs9mIGmzR3EUlhitoNdaDygaxUukbr5fnMMCp4q2srqHtwKL5EjAXU46qmdKnn',
    ]);
    $response = $this->get('/api/v1/');

    Log::info($response->content());

    expect($response->status())->toBe(200);
});