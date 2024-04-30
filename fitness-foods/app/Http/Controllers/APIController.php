<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class APIController extends Controller
{  
    public function __construct(protected ApiService $apiService)
    {

    }

    public function __invoke()
    {   
        return $this->apiService->getInfoApi();
    }
}

